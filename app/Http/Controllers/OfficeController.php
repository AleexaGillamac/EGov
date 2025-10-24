<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfficeRequest;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class OfficeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Office::class, 'office');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user && in_array($user->role, ['superadmin', 'admin'])) {
            $offices = Office::all();
        } else {
            // Only limited fields
            $offices = Office::select('id', 'name', 'phone', 'email')->get();
        }

        return Inertia::render('offices/Index', ['offices' => $offices]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('offices/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfficeRequest $request)
    {
        $validatedData = $request->validated();

        Office::create($validatedData);

        return redirect()->route('offices.officesIndex')->with('success', 'Office created succesfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Office $office)
    {
        return Inertia::render('offices/officesShow', compact('office'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Office $office)
    {
        $this->authorize('update', $office);

        return Inertia::render('offices/officesEdit', [
            'office' => $office,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Office $office)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Office $office)
    {

        $office->delete();

        return Redirect::route('offices.officesIndex')->with('success', 'Office deleted successfully.');
    }
}
