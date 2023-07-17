<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Mobil;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peminjamans = Peminjaman::latest()->get();
        $mobils = Mobil::latest()->get();
        return view('peminjamans.index', compact('peminjamans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $mobils = Mobil::all();
        return view('peminjamans.create', ['mobils' => $mobils]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input peminjaman
        $request->validate([
            'mobil_id' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
        ]);

        // Cek ketersediaan mobil pada tanggal yang diminta
        $mobil = Mobil::find($request->mobil_id);
        $available = $this->checkAvailability($mobil, $request->tanggal_mulai, $request->tanggal_selesai);
        

        if (!$available) {
            return redirect('/peminjaman')->with('error', 'Mobil tidak tersedia pada tanggal tersebut!');
        }

        // Simpan data peminjaman dalam database
        Peminjaman::create([
            'mobil_id' => $request->mobil_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        // Redirect ke halaman yang sesuai
        return redirect('/peminjaman')->with('success', 'Peminjaman berhasil!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function checkAvailability($mobil, $startDate, $endDate)
    {
        $mobils = Mobil::all();
        // Cek apakah mobil tersebut tersedia pada rentang tanggal yang diminta
        $peminjamans = Peminjaman::where('mobil_id', $mobil->id)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where(function ($q) use ($startDate, $endDate) {
                    $q->where('tanggal_mulai', '>=', $startDate)
                        ->where('tanggal_mulai', '<=', $endDate);
                })
                ->orWhere(function ($q) use ($startDate, $endDate) {
                    $q->where('tanggal_selesai', '>=', $startDate)
                        ->where('tanggal_selesai', '<=', $endDate);
                })
                ->orWhere(function ($q) use ($startDate, $endDate) {
                    $q->where('tanggal_mulai', '<=', $startDate)
                        ->where('tanggal_selesai', '>=', $endDate);
                });
            })
            ->get();

        return $mobils->isEmpty();
    }
    
}
