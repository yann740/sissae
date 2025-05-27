<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesure extends Model
{
    protected $fillable = [
        'indicateur',
        'zone',
        'valeur',
        'date_releve',
        'statut',
    ];
}