<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Get user complaints
        $complaints = Complaint::where('user_id', $user->id)
            ->with('office')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Stats
        $total = Complaint::where('user_id', $user->id)->count();
        $resolved = Complaint::where('user_id', $user->id)->where('status', 'Resolved')->count();
        $pending = Complaint::where('user_id', $user->id)->where('status', 'Pending')->count();

        // Optional: Average resolution time
        $avgResolution = Complaint::where('user_id', $user->id)
            ->where('status', 'Resolved')
            ->whereNotNull('resolved_at')
            ->get()
            ->map(function ($c) {
                return Carbon::parse($c->created_at)->diffInDays(Carbon::parse($c->resolved_at));
            })
            ->avg();

        return Inertia::render('Dashboard/Index', [
            'stats' => [
                'total' => $total,
                'resolved' => $resolved,
                'pending' => $pending,
                'avgResolution' => $avgResolution ? round($avgResolution, 1) . ' days' : 'N/A',
            ],
            'recentComplaints' => $complaints->map(function ($c) {
                return [
                    'type' => $c->category ?? 'N/A',
                    'status' => $c->status,
                    'date' => $c->created_at->format('M d, Y'),
                    'office' => $c->office->label ?? 'Unassigned',
                ];
            }),
            'chart' => [
                'labels' => ['Resolved', 'Pending'],
                'data' => [$resolved, $pending],
            ],
        ]);
    }
}
