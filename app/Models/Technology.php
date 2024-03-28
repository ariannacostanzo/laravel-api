<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'color'];
    
    //lego technology a projects
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function getDate($date, $format = 'd-m-Y')
    {
        return Carbon::create($date)->format($format);
    }
}
