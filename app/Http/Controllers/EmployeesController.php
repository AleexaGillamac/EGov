<?php
namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Offices;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmployeesController extends Controller
{
    // public function index()
    // {
    //     return Inertia::render('employees/Index', [
    //         'offices' => Employees::all(),
    //     ]);

    // }

    // public function create()
    // {
    //     return Inertia::render('employees/Create');
    // }

    // public function show(Employees $employees)
    // {
    //     return Inertia::render('employees/Index', [
    //         'offices' => $employees,
    //     ]);

    // }

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'name'        => 'required|string|min:10',
    //         'description' => 'required|string',
    //     ]);

    //     Offices::create($data);

    //     return redirect()->route('employees.index')->with('message', "Office has been created.");

    // }

    // public function edit(Offices $employee)
    // {
    //     return Inertia::render('employees/Edit', ['employee', $employee]);

    // }

    // public function update(Request $request, Employees $employee)
    // {
    //     $request->validate([
    //         'name'        => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //     ]);

    //     $employee->update($request->all());

    //     return redirect()->route(Inertia::render('employees.index'))
    //         ->with('success', 'Employee updated successfully.'); //change this to an event and listener

    // }

}
