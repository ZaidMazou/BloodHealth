<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hospital;
use App\Models\BloodPocket;
use App\Models\Transaction;
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

        $transactions = Transaction::with(['adminUser', 'hospital'])
        ->orderBy('id', 'desc')
        ->where('hopital',$hospital)
        ->paginate(5);

        return view('admin.index',[
            'blood'=>$blood,
            'countblood'=>$countblood,
            'transactions'=>$transactions
        ]);
    }

    public function superadminvisual() {
        
        $userscount = User::where('admin',0)->count();
        $hospital = Hospital::count();
        $bloods = BloodPocket::select('group_sanguin', DB::raw('sum(quantite) as total'))->groupBy('group_sanguin')->get();

        $transactions = Transaction::with(['adminUser', 'hospital'])
        ->orderBy('id', 'desc')
        ->paginate(5);
        
        $blood =  BloodPocket::sum('quantite');
        
        return view('admin.superadminvisual',[
            'blood'=>$blood,
            'hospital'=>$hospital,
            'userscount'=>$userscount,
            'bloods'=>$bloods,
            'transactions' => $transactions
        ]);
    }
}
