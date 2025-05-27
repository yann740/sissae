<?php

namespace App\Http\Controllers;

use App\Models\Mesure;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Carbon\Carbon;
use App\Imports\MesuresImport;

class MesureController extends Controller
{
   public function index()
{
      $mesures = Mesure::orderBy('date_releve', 'desc')->paginate(15);
    return view('statistiques.mesures', compact('mesures'));
}


public function import(Request $request)
{
    Excel::import(new MesuresImport, $request->file('fichier_excel'));

    return back()->with('success', 'Importation réussie.');
}

public function edit($id)
{
    $mesure = Mesure::findOrFail($id);
    return view('mesures.edit', compact('mesure'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'indicateur' => 'required|string',
        'zone' => 'required|string',
        'valeur' => 'required',
        'date_releve' => 'required|date',
    ]);

    $mesure = Mesure::findOrFail($id);
    $mesure->update($request->all());

    return redirect()->route('mesures.index')->with('success', 'Mesure mise à jour.');
}

public function valider($id)
{
    $mesure = Mesure::findOrFail($id);
    $mesure->statut = 'validé';
    $mesure->save();

  return redirect()->route('mesures.index')->with('success', 'Mesure validée avec succès.');
}


}
