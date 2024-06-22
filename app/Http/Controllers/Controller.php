<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function login_form()
    {
        return view('layout.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username'=> ['required'],
            'password'=> ['required']
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }
        return back()->with('loginError', 'Login Gagal');
    }

    public function dashboard()
    {
        $timestamps = Tagihan::select(DB::raw('YEAR(created_at) as year'))
        ->groupBy(DB::raw('YEAR(created_at)'))
        ->get()
        ->pluck('year')
        ->all();
        // return($timestamps);
        $selectedYear = date('Y');


        return view('layout.dashboard', compact('timestamps', 'selectedYear'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

    public function chart_pemakaian(Request $request)
    {
        $client = Auth::user()->kode_client;
        $year = $request->query('year', date('Y'));
        
        $data = Tagihan::select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('SUM(pemakaian) as total_pemakaian'))
        ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
        ->where('tagihan.kode_client', '=', $client)
        ->whereYear('created_at', '=', $year)
        ->get();

        $labels = [];
        $totals = [];

        foreach ($data as $item) {
            $labels[] = \Carbon\Carbon::createFromDate($item->year, $item->month)->format('F Y');
            $totals[] = $item->total_pemakaian;
        }

        return response()->json([
            'labels' => $labels,
            'totals' => $totals,
        ]);
    }
    
    public function chart_tagihan(Request $request)
    {
        $client = Auth::user()->kode_client;
        $year = $request->query('year', date('Y'));
        $data = Tagihan::select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('SUM(tagihan) as total_tagihan'))
        ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
        ->where('tagihan.kode_client', '=', $client)
        ->whereYear('created_at', '=', $year)
        ->get();

        $labels = [];
        $totals = [];

        foreach ($data as $item) {
            $labels[] = \Carbon\Carbon::createFromDate($item->year, $item->month)->format('F Y');
            $totals[] = $item->total_tagihan;
        }

        return response()->json([
            'labels' => $labels,
            'totals' => $totals,
        ]);
    }
}
