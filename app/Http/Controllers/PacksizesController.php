<?php

namespace App\Http\Controllers;

use App\Models\Packsizes;
use Illuminate\Http\Request;

class PacksizesController extends Controller
{
    public function index()
    {
        $packsizes = Packsizes::all();
        return view('packsizes.index', compact('packsizes'));
    }

    public function create()
    {
        return view('packsizes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'size' => 'required',
            'unit' => 'required',
        ]);

        Packsizes::create($request->all());

        return redirect()->route('packsizes.index')
            ->with('success', 'Packsize created successfully.');
    }

    public function show(Packsizes $packsizes)
    {
        return view('packsizes.show', compact('packsizes'));
    }

    public function edit(Packsizes $packsizes)
    {
        return view('packsizes.edit', compact('packsizes'));
    }

    public function update(Request $request, Packsizes $packsizes)
    {
        $request->validate([
            'name' => 'required',
            'size' => 'required',
            'unit' => 'required',
        ]);

        $packsizes->update($request->all());

        return redirect()->route('packsizes.index')
            ->with('success', 'Packsize updated successfully');
    }

    public function destroy(Packsizes $packsizes)
    {
        $packsizes->delete();

        return redirect()->route('packsizes.index')
            ->with('success', 'Packsize deleted successfully');
    }
}