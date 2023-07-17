<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Carbon\Carbon;
class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengembalians = Pengembalian::latest()->get();
        $peminjamans = Peminjaman::latest()->get();
        return view('pengembalians.index', compact('pengembalians'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        return view('pengembalians.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // Validasi input pengembalian
        $request->validate([
            'no_plat' => 'required',
        ]);

        // Cari data peminjaman berdasarkan nomor plat mobil
        $peminjaman = Peminjaman::where('no_plat', $request->no_plat)->first();

        // Verifikasi pengembalian mobil
        if (!$peminjaman) {
            return redirect('/pengembalian')->with('error', 'Mobil dengan nomor plat tersebut tidak ditemukan!');
        }

        // Hitung jumlah hari penyewaan
        $startDate = Carbon::parse($peminjaman->tanggal_mulai);
        $endDate = Carbon::parse($peminjaman->tanggal_selesai);
        $daysRented = $endDate->diffInDays($startDate);

        // Hitung jumlah biaya sewa
        $mobil = Mobil::find($peminjaman->mobil_id);
        $totalCost = $daysRented * $mobil->tarif_sewa;

        // Simpan data pengembalian dalam database
        $booking->update([
            'tanggal_pengembalian' => Carbon::now(),
            'jumlah_hari' => $daysRented,
            'biaya_sewa' => $totalCost,
        ]);

        // Redirect ke halaman yang sesuai
        return redirect('/pengembalian')->with('success', 'Mobil berhasil dikembalikan!');
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
}
