<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
     /**
     * Display a listing of feedbacks based on the user's role.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Citizen')) {
            // Citizen sees feedbacks only for their own complaints
            $feedbacks = Feedback::whereHas('complaint', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->with(['complaint', 'office', 'employee'])
            ->latest()
            ->get();

        } elseif ($user->hasAnyRole(['Employee', 'Office Head'])) {
            // Office employees see feedbacks from their own office
            $feedbacks = Feedback::where('office_id', $user->office_id)
                ->with(['complaint', 'employee'])
                ->latest()
                ->get();

        } else {
            // Admin and Superadmin see all feedbacks
            $feedbacks = Feedback::with(['complaint', 'office', 'employee'])
                ->latest()
                ->get();
        }

        return Inertia::render('Feedbacks/Index', [
            'feedbacks' => $feedbacks,
        ]);
    }

    /**
     * Show the form for creating new feedback linked to a complaint.
     */
    public function create(Complaint $complaint)
    {
        $this->authorize('create', [Feedback::class, $complaint]);

        return Inertia::render('Feedbacks/Create', [
            'complaint' => $complaint->load(['user', 'office', 'category']),
        ]);
    }

    /**
     * Store a newly created feedback in storage.
     */
    public function store(Request $request, Complaint $complaint)
    {
        $this->authorize('create', [Feedback::class, $complaint]);

        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Feedback::create([
            'complaint_id' => $complaint->id,
            'office_id' => Auth::user()->office_id,
            'employee_id' => Auth::id(),
            'subject' => $validated['subject'],
            'description' => $validated['description'],
        ]);

        // Update complaint status
        $complaint->update(['status' => 'Resolved']);

        return redirect()->route('feedbacks.index')
            ->with('success', 'Feedback submitted successfully.');
    }

    /**
     * Display the specified feedback.
     */
    public function show(Feedback $feedback)
    {
        $this->authorize('view', $feedback);

        return Inertia::render('Feedbacks/Show', [
            'feedback' => $feedback->load(['complaint', 'office', 'employee']),
        ]);
    }

    /**
     * Remove feedback (admin only).
     */
    public function destroy(Feedback $feedback)
    {
        $this->authorize('delete', $feedback);

        $feedback->delete();

        return back()->with('success', 'Feedback deleted successfully.');
    }
}
