<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hospital;
use App\Models\BloodPocket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index() {
        $hospital = Hospital::where('admin', Auth::user()->id)->value('id');
        $blood = BloodPocket::where('hopital', $hospital)
        ->select('group_sanguin', DB::raw('sum(quantite) as total'))
        ->groupBy('group_sanguin')
        ->get();
        $countblood = BloodPocket::where('hopital', $hospital)->select(DB::raw("sum(quantite) as total"))->first();

    
        return view('admin.index',[
            'blood'=>$blood,
            'countblood'=>$countblood
        ]);
    }

    public function superadminvisual() {
        
        $userscount = User::where('admin',0)->count();
        $hospital = Hospital::count();
        $bloods = BloodPocket::select('group_sanguin', DB::raw('sum(quantite) as total'))->groupBy('group_sanguin')->get();
        
        $blood =  BloodPocket::sum('quantite');
        dd($blood);
        return view('admin.superadminvisual');
    }
}
