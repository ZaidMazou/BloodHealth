<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function displayprofile() {

        $user = Auth::user();
        return view('admin.profiledisplay',[
            'user'=>$user
        ]);
    }

    public function upadateprofile(Request $request) {
        $user = Auth::user();
    
        $request->validate([
            'profession' => 'string|nullable',
            'telephone' => 'string|nullable',
            'picture' => 'nullable|image'  
        ]);
    
        if ($request->hasFile('picture')) {
            // Supprimer l'ancienne image si elle existe
            if ($user->picture && Storage::disk('public')->exists($user->picture)) {
                Storage::disk('public')->delete($user->picture);
            }
    
            // Gérer le nouveau fichier image
            $file = $request->file('picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('users/profile', $filename, 'public');
            $request->merge(['picture' => $path]);  // Mettez à jour le tableau de requêtes avec le nouveau chemin
        }
    
        // Mettre à jour les autres champs
        $user->profession = $request->input('profession');
        $user->telephone = $request->input('telephone');
        $user->picture = $request->input('picture', $user->picture);  // Conservez l'ancienne image si aucune nouvelle image n'est uploadée
    
        $user->save();
    
        return to_route('admin.profile')->with('success', 'Profile modifié avec succès');
    }
}
