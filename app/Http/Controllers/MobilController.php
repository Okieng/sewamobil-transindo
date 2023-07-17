<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mobils = Mobil::latest()->get();
        return view('mobils.index', compact('mobils'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mobils.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'no_plat' => 'required',
            'merk' => 'required',
            'model' => 'required',
            'tarif_sewa' => 'required'
        ]);

        $mobil = Mobil::create([
            'no_plat' => $request->no_plat,
            'merk' => $request->merk,
            'model' => $request->model,
            'tarif_sewa' => $request->tarif_sewa
        ]);

        if ($mobil) {
            return redirect()
                ->route('mobil.index')
                ->with([
                    'success' => 'Data mobil berhasil ditambah'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
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
        $mobil = Mobil::findOrFail($id);
        return view('mobils.edit', compact('mobil'));
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
        $this->validate($request, [
            'no_plat' => 'required',
            'merk' => 'required',
            'model' => 'required',
            'tarif_sewa' => 'required'
        ]);

        $mobil = Mobil::findOrFail($id);

        $mobil->update([
            'no_plat' => $request->no_plat,
            'merk' => $request->merk,
            'model' => $request->model,
            'tarif_sewa' => $request->tarif_sewa
        ]);

        if ($mobil) {
            return redirect()
                ->route('mobil.index')
                ->with([
                    'success' => 'Data mobil berhasil di update'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem has occured, please try again'
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mobil = Mobil::findOrFail($id);
        $mobil->delete();

        if ($mobil) {
            return redirect()
                ->route('mobil.index')
                ->with([
                    'success' => 'Mobil has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('mobil.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
