<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audiencia extends Model
{
    use HasFactory;

    static $rules = [
        'title' => 'required',
        'start' => 'required',
        'end' => 'required',
        'tipo_audiencia' => 'required',
        'sala' => 'required',
        'magis' => 'required',
        'textColor' => 'required',
        'backgroundColor' => 'required',
    ];

    protected $fillable = ['title', 'start', 'end', 'tipo_audiencia', 'sala', 'magis', 'abo_patrocinante', 'observaciones', 'textColor', 'backgroundColor'];

    protected $primaryKey = 'id';
    public $incrementing = true;
}
