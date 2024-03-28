<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProjectController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //todo spezzare la query
        $projects = Project::orderByDesc('updated_at')->orderByDesc('created_at')->get();
        $types = Type::all();
        $type_filter = $request->query('type_filter');

        //todo fare la logica di filter
        
        
        return view('admin.projects.index', compact('projects', 'types', 'type_filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        $types = Type::select('label', 'id')->get();
        $technologies = Technology::select('label', 'id')->get();
        return view('admin.projects.create', compact('project', 'types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|unique:projects',
            'description' => 'required|string',
            'image' => 'nullable|image',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|exists:technologies,id'
        ], [
            'title.required' => 'Inserisci il titolo del progetto',
            'description.required' => 'Inserisci la descrizione del progetto',
            'image.image' => 'Il formato immagine non è corretto',
            'type_id.exists' => 'La tipologia non è valida',
            'technologies.exists' => 'Le tecnologie scelte non sono valide',
        ]);

        

        $data = $request->all();

        $project = new Project();
        
        $project->fill($data);

        $project->slug = Str::slug($project->title);

        //gestisco l'immagine che mi arriva
        if (Arr::exists($data, 'image')) {
            $extension = $data['image']->extension();
            $img_url = Storage::putFileAs('project_images', $data['image'], "$project->slug.$extension");
            $project->image = $img_url;
        }

        
        $project->save();

        if(Arr::exists($data, 'technologies')) 
        {
            $project->technologies()->attach($data['technologies']);
        }

        return to_route('admin.projects.show', $project->id)
            ->with('message', "Progetto '$project->title' creato con successo!")
            ->with('type', "success");
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.show', compact('project', 'types'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::select('label', 'id')->get();
        $technologies = Technology::select('label', 'id')->get();
        $previous_techs = $project->technologies->pluck('id')->toArray();
        return view('admin.projects.edit', compact('project', 'types', 'technologies', 'previous_techs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => ['required', 'string', Rule::unique('projects')->ignore($project->id)],
            'description' => 'required|string',
            'image' => 'nullable|image',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|exists:technologies,id'
        ], [
            'title.required' => 'Inserisci il titolo del progetto',
            'description.required' => 'Inserisci la descrizione del progetto',
            'image.url' => 'Il formato immagine non è corretto',
            'type_id.exists' => 'La tipologia non è valida',
            'technologies.exists' => 'Le tecnologie non sono valide',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);

        //gestisco l'immagine, se mi arriva
        if (Arr::exists($data, 'image')) {
            //controllo se aveva già un immagine e la cancella
            if ($project->image) Storage::delete($project->image);

            $extension = $data['image']->extension();
            $img_url = Storage::putFileAs('project_images', $data['image'], "{$data['slug']}.$extension");
            $project->image = $img_url;
        }

        $project->update($data);

        //se ho inviato qualche checkbox sincronizzo i valori con project
        if (Arr::exists($data, 'technologies')) {
            $project->technologies()->sync($data['technologies']);
            //se invece non ho checkbox inviati e il progetto ne aveva allora significa che li devo togliere tutti
        } elseif (!Arr::exists($data, 'technologies') && $project->has('technologies')) {
            $project->technologies()->detach();
        }

        return to_route('admin.projects.show', $project->id)
            ->with('message', "Progetto '$project->title' modificato con successo!")
            ->with('type', "info");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('admin.projects.index')
            ->with('message', "Progetto '$project->title' eliminato con successo!")
            ->with('type', "danger");
    }

    public function trash()
    {
        $projects = Project::onlyTrashed()->get();
        return view('admin.projects.trash', compact('projects'));
    }

    public function restore(Project $project)
    {
        $project->restore();
        return to_route('admin.projects.index')
            ->with('message', "Progetto '$project->title' ripristinato con successo!")
            ->with('type', "success");
    }

    public function drop(Project $project)
    {
        if ($project->has('technologies')) $project->technologies()->detach();
        if ($project->image) Storage::delete($project->image);
        $project->forceDelete();
        return to_route('admin.projects.trash')
        ->with('message', "Progetto '$project->title' eliminato definitivamente!")
        ->with('type', "danger");
    }
}
