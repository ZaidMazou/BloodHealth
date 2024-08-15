<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer tous les hôpitaux et les passer à la vue
        $hospitals = Hospital::all();
        return view('admin.showallhospital', compact('hospitals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hospital = new Hospital();
        
        $users = User::all(); // Récupérer tous les utilisateurs pour les administrateurs

        return view('admin.createhospital', [
            'hospital' => $hospital,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données de la requête
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'admin' => 'required|exists:users,id',
        ]);

        // Créer un nouvel hôpital avec les données validées
        Hospital::create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'admin' => $request->admin,
        ]);

        return redirect()->route('admin.hopital.index')->with('success', 'Hôpital créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hospital =Hospital::where('admin', $id)->first();
        
        return view('admin.showhopital', compact('hospital'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::all(); // Récupérer tous les utilisateurs pour les administrateurs
        $hospital = Hospital::findOrfail($id);
        return view('admin.updatehospital', [
            'hospital' => $hospital,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hospital = Hospital::findOrfail($id);
        
        // Valider les données de la requête
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
        ]);

        
        $hospital->update([
            'name' => $request->name,
            'email'=>$request->email,
            'telephone'=>$request->telephone,
            'adresse'=> $request->adresse
        ]);


        return redirect()->route('admin.')->with('success', 'Hôpital mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hospital = Hospital::findOrfail($id);

        $hospital->delete();
        return redirect()->route('admin.hopital.index')->with('success', 'Hôpital supprimer avec succès.');
    }
}
