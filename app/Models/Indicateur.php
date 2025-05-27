<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indicateur extends Model
{
    protected $fillable = [
        'code',
        'nom',
        'categorie',
        'unite',
        'seuil_critique',
    ];
}