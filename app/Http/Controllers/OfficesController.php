<?php

namespace App\Http\Controllers;

use App\Models\Offices;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OfficesController extends Controller
{
    public function index()
    {
        return Inertia::render('offices/Index', []);
    }

    public function create()
    {
        return Inertia::render('offices/Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:10',
            'description' => 'required|string',
        ]);

        Offices::create($data);
        
        return redirect()->route('offices.index')->with('message', "Office has been created.");

    }
}
