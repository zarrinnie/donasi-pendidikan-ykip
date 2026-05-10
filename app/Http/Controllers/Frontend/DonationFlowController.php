<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\DonationPackage;
use App\DTOs\StoreGuestDonationDTO;
use App\Actions\ProcessGuestDonationAction;
use App\Actions\GenerateQrisCodeAction;

class DonationFlowController extends Controller
{
    /**
     * Show the donation form.
     */
    public function create()
    {
        $packages = DonationPackage::where('is_active', true)->orderBy('sort_order')->get();
        return view('Features.DonationFlow.pages.donation', compact('packages'));
    }

    /**
     * Process the submitted donation form.
     */
    public function store(Request $request, ProcessGuestDonationAction $action)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'nullable|string',
            'occupation' => 'nullable|string',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string',
            'donation_tier' => 'required|string',
            'amount' => 'required|numeric|min:10000',
            'frequency' => 'required|string',
        ]);

        $dto = new StoreGuestDonationDTO(
            name: $validated['name'],
            gender: $validated['gender'] ?? null,
            occupation: $validated['occupation'] ?? null,
            email: $validated['email'],
            phone: $validated['phone'] ?? null,
            donation_tier: $validated['donation_tier'],
            amount: (int)$validated['amount'],
            frequency: $validated['frequency']
        );

        $donation = $action->execute($dto);
        
        return redirect()->route('donation.payment', ['donation' => $donation->id]);
    }

    /**
     * Show the payment QRIS page.
     */
    public function payment(Donation $donation, GenerateQrisCodeAction $qrisAction)
    {
        $qrisPayload = $qrisAction->execute($donation->amount);
        return view('Features.DonationFlow.pages.payment', compact('donation', 'qrisPayload'));
    }

    /**
     * Show the final receipt page.
     */
    public function receipt(Donation $donation)
    {
        return view('Features.DonationFlow.pages.thank-you', compact('donation'));
    }
}
