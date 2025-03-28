<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contribution;
use App\Models\Donation;
use App\Models\Member;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMembers = Member::count();
        $totalContributions = Contribution::sum('amount');
        $totalDonations = Donation::sum('amount');
        $recentTransactions = Contribution::with('member')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'total_members' => $totalMembers,
            'total_contributions' => $totalContributions,
            'total_donations' => $totalDonations,
            'recent_transactions' => $recentTransactions,
        ], 200);
    }
}
