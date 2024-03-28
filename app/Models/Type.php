<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'color'];

    //lego type a projects
    public function projects() 
    {
        return $this->hasMany(Project::class);
    }

    public function getDate($date, $format = 'd-m-Y')
    {
        return Carbon::create($date)->format($format);
    }
}
