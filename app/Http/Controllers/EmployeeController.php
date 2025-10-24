<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    public function __construct()
    {
        // Only users with appropriate roles can access
        $this->middleware(['auth', 'role:superadmin|admin|director']);
    }

    /**
     * Show all employees (for Admin/Director)
     */
    public function index()
    {
        $currentUser = auth()->user();

        // Admin can see all employees, director can see employees in their department/office
        if ($currentUser->hasRole('admin')) {
            $employees = User::role('employee')->get();
        } elseif ($currentUser->hasRole('director')) {
            // Example: filter by office_id if using offices
            $employees = User::role('employee')->where('office_id', $currentUser->office_id)->get();
        } else {
            abort(403, 'Unauthorized');
        }

        return Inertia::render('Admin/Employees', [
            'employees' => $employees,
            'currentUser' => $currentUser,
        ]);
    }

    /**
     * Show permissions form for a single employee
     */
    public function editPermissions(User $employee)
    {
        $this->authorize('manage_permissions', $employee); // Optional policy check

        $permissions = Permission::all();
        $userPermissions = $employee->getDirectPermissions()->pluck('name')->toArray();

        return Inertia::render('Admin/EmployeePermissions', [
            'user' => $employee,
            'role' => $employee->roles->first()?->name,
            'permissions' => $permissions,
            'userPermissions' => $userPermissions,
        ]);
    }

    /**
     * Update employee direct permissions
     */
    public function updatePermissions(Request $request, User $employee)
    {
        $this->authorize('manage_permissions', $employee);

        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        $employee->syncPermissions($request->input('permissions', []));

        return redirect()->back()->with('success', 'Permissions updated successfully.');
    }

    /**
     * Optional: Edit employee details (for Admin/Director)
     */
    public function edit(User $employee)
    {
        $this->authorize('update', $employee);

        return Inertia::render('Admin/EditEmployee', [
            'employee' => $employee
        ]);
    }

    /**
     * Optional: Update employee details
     */
    public function update(Request $request, User $employee)
    {
        $this->authorize('update', $employee);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$employee->id,
        ]);

        $employee->update($request->only(['name', 'email']));

        return redirect()->back()->with('success', 'Employee updated successfully.');
    }
}
