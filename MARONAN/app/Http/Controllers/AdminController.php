<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\ClickLog;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        $totalPetani = User::where('role','petani')->count();
        $pendingPetani = User::where('role','petani')
                            ->where('verification_status','pending')
                            ->count();

        $totalProduk = Product::count();
        $totalKlik = ClickLog::count();

        $produkTerpopuler = Product::withCount('clickLogs')
                            ->orderByDesc('click_logs_count')
                            ->take(5)
                            ->get();

        $petaniTerbaru = User::where('role','petani')
                            ->latest()
                            ->take(5)
                            ->get();

        return view('admin.dashboard', compact(
            'totalPetani',
            'pendingPetani',
            'totalProduk',
            'totalKlik',
            'produkTerpopuler',
            'petaniTerbaru'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | LIST PETANI
    |--------------------------------------------------------------------------
    */

    public function petaniIndex(Request $request)
    {
        $query = User::where('role','petani');

        // Filter berdasarkan status
        if ($request->status) {
            $query->where('verification_status', $request->status);
        }

        $petanis = $query->latest()->paginate(10);

        return view('admin.petani.index', compact('petanis'));
    }

    /*
    |--------------------------------------------------------------------------
    | APPROVE PETANI
    |--------------------------------------------------------------------------
    */

    public function approvePetani($id)
    {
        $petani = User::where('role','petani')->findOrFail($id);

        $petani->verification_status = 'approved';
        $petani->save();

        return redirect()->back()->with('success','Petani berhasil disetujui');
    }

    /*
    |--------------------------------------------------------------------------
    | REJECT PETANI
    |--------------------------------------------------------------------------
    */

    public function rejectPetani($id)
    {
        $petani = User::where('role','petani')->findOrFail($id);

        $petani->verification_status = 'rejected';
        $petani->save();

        return redirect()->back()->with('success','Petani ditolak');
    }

    /*
    |--------------------------------------------------------------------------
    | LIST PRODUK
    |--------------------------------------------------------------------------
    */

    public function produkIndex()
    {
        $products = Product::with('user')
                    ->latest()
                    ->paginate(10);

        return view('admin.produk.index', compact('products'));
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS PRODUK
    |--------------------------------------------------------------------------
    */

    public function destroyProduk($id)
    {
        $product = Product::with('user')->findOrFail($id);

        $product->delete();

        return redirect()->route('admin.produk.index')
                ->with('success','Produk berhasil dihapus');
    }
}