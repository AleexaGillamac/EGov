<?php
namespace App\Http\Controllers;

use App\Models\Offices;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OfficesController extends Controller
{
    public function index()
    {
        return Inertia::render('offices/Index', [
            'offices' => Offices::all(),
        ]);

    }

    public function create()
    {
        return Inertia::render('offices/Create');
    }

    // public function show(Offices $offices)
    // {
    //     return Inertia::render('offices/Index', [
    //         'offices' => $offices,
    //     ]);
    // }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|min:10',
            'description' => 'required|string',
        ]);

        Offices::create($data);

        return redirect()->route('offices.index')->with('message', "Office has been created.");

    }

    public function edit(Offices $offices)
    {
        return Inertia::render('offices/Edit', ['offices', $offices]);
    }

    public function update(Request $request, Offices $office)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $office->update($request->all());

        return redirect()->route('offices.index')
            ->with('success', 'Department updated successfully.'); //change this to an event and listener

    }

    public function destroy(Offices $office)
    {
        $office->delete();

        return Inertia::render('offices/Index')
            ->with('success', 'Department deleted successfully.'); //change this to an event and listener

    }

}
