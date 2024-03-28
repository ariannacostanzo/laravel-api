<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|unique:technologies',
            'color' => 'nullable|string',

        ], [
            'label.required' => 'Inserisci l\'etichetta della tecnologia',
            'color.string' => 'Il formato del colore non è corretto',

        ]);

        $data = $request->all();

        $technology = new Technology();

        $technology->fill($data);
        $technology->save();

        return to_route('admin.technologies.show', $technology->id)
            ->with('message', "Tipo '$technology->label' creato con successo!")
            ->with('type', "success");
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        $request->validate([
            'label' =>
            ['required', 'string', Rule::unique('technologies')->ignore($technology->id)],
            'color' => 'nullable|string',

        ], [
            'label.required' => 'Inserisci l\'etichetta della tecnologia',
            'color.string' => 'Il formato del colore non è corretto',

        ]);

        $data = $request->all();
        $technology->update($data);

        return to_route('admin.technologies.show', $technology->id)
            ->with('message', "Tecnologia '$technology->label' modificata con successo!")
            ->with('type', "info");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return to_route('admin.technologies.index')
        ->with('message', "Tecnologia '$technology->label' eliminata con successo!")
        ->with('type', "danger");
    }
}

// todo cestino
