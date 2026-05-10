<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Actions\ToggleWelcomeEmailStatusAction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with donor tracking table.
     */
    public function index()
    {
        // KPIs
        $totalRevenue = Donation::where('payment_status', 'Success')->sum('amount');
        $totalDonors = \App\Models\Donor::count();
        $totalDonations = Donation::count();
        
        // Chart 1: Tier Distribution
        $tierDistribution = Donation::select('donation_tier', \DB::raw('count(*) as count'))
            ->groupBy('donation_tier')
            ->pluck('count', 'donation_tier')
            ->toArray();

        // Chart 2: Revenue over last 30 days
        $last30Days = now()->subDays(30);
        $revenueOverTime = Donation::where('payment_status', 'Success')
            ->where('created_at', '>=', $last30Days)
            ->select(\DB::raw('DATE(created_at) as date'), \DB::raw('sum(amount) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
            
        $chartDates = $revenueOverTime->pluck('date')->map(function($date) {
            return \Carbon\Carbon::parse($date)->format('M d');
        })->toArray();
        $chartRevenues = $revenueOverTime->pluck('total')->toArray();

        // Recent Donations for a mini-table
        $recentDonations = Donation::with('donor')->latest()->take(5)->get();
        
        return view('dashboard', compact(
            'totalRevenue', 
            'totalDonors', 
            'totalDonations', 
            'tierDistribution',
            'chartDates',
            'chartRevenues',
            'recentDonations'
        ));
    }

    /**
     * Toggle the welcome email status for a donation.
     */
    public function toggleWelcomeEmail(Donation $donation, ToggleWelcomeEmailStatusAction $action)
    {
        $action->execute($donation->id);
        
        return back()->with('status', 'Email status successfully updated for ' . $donation->donor->name . '.');
    }
}
