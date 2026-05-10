<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Actions\UpdateDonationAction;
use App\Actions\DeleteDonationAction;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filterTier = $request->input('filterTier');
        $filterFrequency = $request->input('filterFrequency');
        $filterEmailStatus = $request->input('filterEmailStatus');

        $donations = Donation::with('donor')
            ->when($search, function ($query, $search) {
                $query->whereHas('donor', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
                })->orWhere('receipt_number', 'like', "%{$search}%");
            })
            ->when($filterTier, function ($query, $filterTier) {
                $query->where('donation_tier', $filterTier);
            })
            ->when($filterFrequency, function ($query, $filterFrequency) {
                $query->where('frequency', $filterFrequency);
            })
            ->when($filterEmailStatus !== null && $filterEmailStatus !== '', function ($query) use ($filterEmailStatus) {
                $query->where('is_welcome_email_sent', $filterEmailStatus);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.donations.index', compact('donations', 'search', 'filterTier', 'filterFrequency', 'filterEmailStatus'));
    }

    public function store(Request $request)
    {
        // ... (Handled by frontend)
    }

    public function update(Request $request, Donation $donation, UpdateDonationAction $action)
    {
        $validated = $request->validate([
            'payment_status' => 'required|string|in:Pending,Success,Failed',
        ]);

        $is_welcome_email_sent = $request->has('is_welcome_email_sent');

        $action->execute($donation, [
            'payment_status' => $validated['payment_status'],
            'is_welcome_email_sent' => $is_welcome_email_sent,
        ]);

        return back()->with('message', 'Donation successfully updated.');
    }

    public function destroy(Donation $donation, DeleteDonationAction $action)
    {
        $action->execute($donation);
        return back()->with('message', 'Donation successfully deleted.');
    }
}
