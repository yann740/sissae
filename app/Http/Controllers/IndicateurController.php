<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\IndicateursImport;
use App\Models\Indicateur;


class IndicateurController extends Controller
{


    public function index()
{
        $indicateurs = Indicateur::paginate(10); // récupère tous les enregistrements
    return view('statistiques.indicateurs', compact('indicateurs'));
}


    public function import(Request $request)
{
    $request->validate([
        'fichier_excel' => 'required|file|mimes:xlsx,xls',
    ]);

    Excel::import(new IndicateursImport, $request->file('fichier_excel'));

   return redirect()->route('indicateurs.index')->with('success', 'Fichier importé avec succès.');

}

 public function store(Request $request)
    {
        if ($request->hasFile('fichier_excel')) {
            // Importation depuis Excel
            Excel::import(new IndicateursImport, $request->file('fichier_excel'));
            return redirect()->route('indicateurs.index')->with('success', 'Importation réussie !');
        }

        // Création manuelle
        $request->validate([
            'nom' => 'required|string|max:255',
            'valeur' => 'required|numeric',
        ]);

        Indicateur::create([
            'nom' => $request->nom,
            'valeur' => $request->valeur,
        ]);

        return redirect()->route('indicateurs.index')->with('success', 'Indicateur ajouté avec succès.');
    }

    public function edit($id)
{
    $indicateur = Indicateur::findOrFail($id);
    return view('indicateurs.edit', compact('indicateur'));
}

public function valider($id)
{
    $indicateur = Indicateur::findOrFail($id);
    $indicateur->statut = 'validé';
    $indicateur->save();

    return back()->with('success', 'Indicateur validé avec succès.');
}


public function update(Request $request, $id)
{
    $request->validate([
        'nom' => 'required|string',
        // ajoute ici les autres champs à valider
    ]);

    $indicateur = Indicateur::findOrFail($id);
    $indicateur->update($request->all());

    return redirect()->route('indicateurs.index')->with('success', 'Indicateur mis à jour.');
}
}
