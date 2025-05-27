<?php

namespace App\Imports;

use App\Models\Indicateur;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IndicateursImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Indicateur([
            'code' => $row['code'],
            'nom' => $row['nom'],
            'categorie' => $row['categorie'],
            'unite' => $row['unite'],
            'seuil_critique' => $row['seuil_critique'],
        ]);
    }
}
