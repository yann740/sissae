<?php

namespace App\Imports;

use App\Models\Mesure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Carbon\Carbon;

class MesuresImport implements ToModel, WithHeadingRow
{
   public function model(array $row)
{
    // Si 'valeur' est absente ou vide, ne pas insérer cette ligne
    if (empty($row['valeur'])) {
        return null;  // ignore cette ligne
    }

    // Conversion date (comme avant)
    if (is_numeric($row['date_releve'])) {
        $date = Carbon::instance(ExcelDate::excelToDateTimeObject($row['date_releve']))->format('Y-m-d');
    } else {
        try {
            $date = Carbon::createFromFormat('d/m/Y', $row['date_releve'])->format('Y-m-d');
        } catch (\Exception $e) {
            $date = null;
        }
    }

    return new Mesure([
        'indicateur'  => $row['indicateur'],
        'zone'        => $row['zone'],
        'valeur'      => $row['valeur'],
        'date_releve' => $date,
        'statut'      => $row['statut'],
    ]);
}
}
