<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\BloodPocket;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BloodPocketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospital = Hospital::where('admin', Auth::user()->id)->value('id');
        $blood = BloodPocket::where('hopital', $hospital)->orderBy('id','desc')->paginate(15);
        return view('admin.allblood',[
            'blood'=>$blood
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.addblood');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Valider les données de la requête
    $request->validate([
        'group_sanguin' => 'required|string',
        'quantite' => 'required|integer',
        'capacite' => 'required|integer',
    ]);

    // Récupérer l'ID de l'hôpital basé sur l'utilisateur authentifié
    $hospitalId = Hospital::where('admin', Auth::user()->id)->value('id');
    
    // Vérifier si l'ID de l'hôpital est valide
    if (!$hospitalId) {
        return redirect()->back()->with('error', 'Aucun hôpital associé à cet utilisateur.');
    }

    // Vérifier si une poche de sang avec le même type existe pour cet hôpital
    $bloodPocket = BloodPocket::where('hopital', $hospitalId)
                              ->where('group_sanguin', $request->group_sanguin)
                              ->first();

    if ($bloodPocket) {
        // Mettre à jour la quantité de la poche de sang existante
        $bloodPocket->update(['quantite' => $bloodPocket->quantite + $request->quantite]);

        // Enregistrer la transaction
        Transaction::create([
            'admin' => Auth::user()->id,
            'hopital' => $hospitalId,
            'type' => 'Ajout',
            'quantite' => $request->quantite,
            'updated_at'=> now()
        ]);

        return redirect()->route('admin.')->with('success', 'Enregistrement effectué avec succès');
    } else {
        
        // Créer une nouvelle poche de sang
        BloodPocket::create([
            'group_sanguin' => $request->group_sanguin,
            'quantite' => $request->quantite,
            'capacite' => $request->capacite,
            'hopital' => $hospitalId,
        ]);

        Transaction::create([
            'admin' => Auth::user()->id,
            'hopital' => $hospitalId,
            'type' => 'Ajout',
            'quantite' => $request->quantite,
            'updated_at'=> now()
        ]);

        return redirect()->route('admin.')->with('success', 'Enregistrement effectué avec succès');
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.removeblood');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'group_sanguin' => 'required|string',
            'quantite' => 'required|integer',
            'capacite' => 'required|integer',
        ]);

        $hospitalId = Hospital::where('admin', $id)->value('id');
        if (!$hospitalId) {
            return redirect()->back()->with('error', 'Aucun hôpital associé à cet utilisateur.');
        }
    
        // Vérifier si une poche de sang avec le même type existe pour cet hôpital
        $bloodPocket = BloodPocket::where('hopital', $hospitalId)
                                  ->where('group_sanguin', $request->group_sanguin)
                                  ->first();

        if ($bloodPocket && $bloodPocket->quantite > $request->quantite) {
        // Mettre à jour la quantité de la poche de sang existante
        $bloodPocket->update(['quantite' => $bloodPocket->quantite - $request->quantite]);

        // Enregistrer la transaction
        Transaction::create([
            'admin' => Auth::user()->id,
            'hopital' => $hospitalId,
            'type' => 'Retrait',
            'quantite' => $request->quantite,
            'updated_at'=> now()
        ]);

        return redirect()->route('admin.')->with('success', 'Enregistrement effectué avec succès');
    } else {
        
        return redirect()->route('admin.')->with('error', 'Vous ne disposer peut-être pas de ce groupe sanguin ou la quantité est superieur à celle disponible');
    }
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
