<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Office;
use App\Models\Category;
use App\Models\Complaint;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ComplaintRequest;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the complaints based on role.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('user')) {
            // Citizen sees only their own complaints
            $complaints = Complaint::where('user_id', $user->id)
                ->with(['office', 'category'])
                ->latest()
                ->get();
        } elseif ($user->hasRole(['employee', 'director'])) {
            // Office staff see complaints assigned to their office
            $complaints = Complaint::where('office_id', $user->office_id)
                ->with(['user', 'category'])
                ->latest()
                ->get();
        } else {
            // Admins see all complaints
            $complaints = Complaint::with(['user', 'office', 'category'])
                ->latest()
                ->get();
        }

        return Inertia::render('complaints/Index', [
            'complaints' => $complaints,
        ]);
    }

    /**
     * Show the form for creating a new complaint.
     */
    public function create()
    {
        return Inertia::render('complaints/Create', [
            'categories' => Category::select('id', 'label', 'office_id')->get(),
            'offices' => Office::select('id', 'name')->get(),
        ]);
    }

    /**
     * Store a newly created complaint in storage.
     */
    public function store(ComplaintRequest $request)
    {
        $validated = $request->validated();

        $userId = $request->boolean('anonymous') ? null : Auth::id();

        $complaint = Complaint::create([
            'user_id' => $userId,
            'office_id' => $validated['office_id'] ?? null,
            'category_id' => $validated['category_id'],
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'anonymous' => $request->boolean('anonymous'),
            'status' => 'Pending',
        ]);

        // Save attachments (if any)
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('attachments', 'public');

                Attachment::create([
                    'complaint_id' => $complaint->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return to_route('complaints.index')->with('success', 'Complaint submitted successfully.');
    }

    /**
     * Display the specified complaint.
     */
    public function show(Complaint $complaint)
    {
        $complaint->load(['user', 'office', 'category', 'attachments']);

        $this->authorize('view', $complaint);

        return Inertia::render('complaints/Show', [
            'complaint' => $complaint,
        ]);
    }

    /**
     * Update complaint status (for office/admin).
     */
    public function update(Request $request, Complaint $complaint)
    {
        $this->authorize('update', $complaint);

        $validated = $request->validate([
            'status' => 'required|string|in:Pending,Processing,Resolved,Rejected',
        ]);

        $complaint->update($validated);

        return back()->with('success', 'Complaint status updated.');
    }

    /**
     * Remove the specified complaint (admin only).
     */
    public function destroy(Complaint $complaint)
    {
        $this->authorize('delete', $complaint);

        // Delete complaint (attachments cascade automatically)
        $complaint->delete();

        return back()->with('success', 'Complaint deleted successfully.');
    }
}
