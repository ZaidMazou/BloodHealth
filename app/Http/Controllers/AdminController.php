<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hospital;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\BloodPocket;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function index()
    {
        if (Gate::allows('acces-superadmin')) {
            abort('403');
        }
        $hospital = Hospital::where('admin', Auth::user()->id)->value('id');
        $blood = BloodPocket::where('hopital', $hospital)
            ->select('group_sanguin', DB::raw('sum(quantite) as total'))
            ->groupBy('group_sanguin')
            ->get();
        $countblood = BloodPocket::where('hopital', $hospital)->select(DB::raw("sum(quantite) as total"))->first();

        $transactions = Transaction::with(['adminUser', 'hospital'])
            ->orderBy('id', 'desc')
            ->where('hopital', $hospital)
            ->paginate(5);

        return view('admin.index', [
            'blood' => $blood,
            'countblood' => $countblood,
            'transactions' => $transactions
        ]);
    }

    public function superadminvisual()
    {

        if (! Gate::allows('acces-superadmin')) {
            abort('403');
        }

        $userscount = User::where('admin', 0)->count();
        $hospital = Hospital::count();
        $bloods = BloodPocket::select('group_sanguin', DB::raw('sum(quantite) as total'))->groupBy('group_sanguin')->get();

        $transactions = Transaction::with(['adminUser', 'hospital'])
            ->orderBy('id', 'desc')
            ->paginate(5);

        $blood =  BloodPocket::sum('quantite');

        // $bloodPerHospital = BloodPocket::with(['hospital'])
        // ->select('group_sanguin', DB::raw('sum(quantite) as total'))
        // ->groupBy('group_sanguin')
        // ->get();

        // dd($bloodPerHospital);

        return view('admin.superadminvisual', [
            'blood' => $blood,
            'hospital' => $hospital,
            'userscount' => $userscount,
            'bloods' => $bloods,
            'transactions' => $transactions
        ]);
    }

    public function exportTransactionsToPdf(Request $request)
    {
        // Valider les dates
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Récupérer les transactions entre les dates
        $query = Transaction::query();

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        } elseif ($request->has('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        } elseif ($request->has('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $transactions = $query->with(['adminUser', 'hospital'])->get();

      

        // Générer le PDF avec les données des transactions
        $pdf = Pdf::loadView('transaction.pdf', compact('transactions'));

        // Télécharger le fichier PDF
        return $pdf->download('transactions.pdf');
    }

    public function transactionsToPdf()
    {
        return view('admin.downloadtransaction');
    }

    public function consommation()
    {

        $hospitals = Hospital::with('userAdmin')->get();
        $consommation = Transaction::where('type', 'Retrait')
            ->select('group_sanguin', DB::raw('sum(quantite) as total'))
            ->groupBy('group_sanguin')
            ->get();

        return view('admin.consommation', [
            'consommation' => $consommation,
            'hospitals' => $hospitals
        ]);
    }

    public function searchconsommation(Request $request)
    {

        $request->validate([
            'group_sanguin' => 'nullable|string',
            'hopital' => 'nullable',
            'debut' => 'nullable|date',
            'fin' => 'nullable|date|after_or_equal:debut',
        ]);
        
        $query = Transaction::query();
        
        // Filtrer par groupe sanguin
        if ($request->filled('group_sanguin')) {
            $query->where('group_sanguin', '=', $request->group_sanguin);
        }
        
        // Filtrer par hôpital
        if ($request->filled('hopital')) {
            $query->where('hopital', '=', $request->hopital);
        }
        
        // Filtrer par date de début et date de fin
        if ($request->filled('debut') && $request->filled('fin')) {
            $query->whereBetween('created_at', [$request->debut, $request->fin]);
        } elseif ($request->filled('debut')) {
            $query->whereDate('created_at', '>=', $request->debut);
        } elseif ($request->filled('fin')) {
            $query->whereDate('created_at', '<=', $request->fin);
        }
        
        // Calculer la somme des quantités
        $totalQuantite = $query->sum('quantite');
        
        // Récupérer les transactions avec les relations
        $transactions = $query->with(['adminUser', 'hospital'])->get();
        
        // Retourner la vue avec les données
        
        return view('admin.consommationview', [
            'transactions' => $transactions,
            'totalQuantite' => $totalQuantite,
            'debut'=> $request->debut,
            'fin'=> $request->fin,
            'group_sanguin'=>$request-> group_sanguin,
            'hospital' =>Hospital::findOrfail($request->hopital)->name
        ]);
    }
}
