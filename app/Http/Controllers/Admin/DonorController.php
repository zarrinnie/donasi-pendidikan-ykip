<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use App\Actions\UpdateDonorAction;
use App\Actions\DeleteDonorAction;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $donors = Donor::when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.donors.index', compact('donors', 'search'));
    }

    public function store(Request $request)
    {
        // ... (Not requested for this context, mostly managed by frontend)
    }

    public function update(Request $request, Donor $donor, UpdateDonorAction $action)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:donors,email,' . $donor->id,
            'phone' => 'nullable|string',
            'occupation' => 'nullable|string',
            'gender' => 'nullable|string',
        ]);

        $action->execute($donor, $validated);

        return back()->with('message', 'Donor successfully updated.');
    }

    public function destroy(Donor $donor, DeleteDonorAction $action)
    {
        $action->execute($donor);
        return back()->with('message', 'Donor successfully deleted.');
    }
}
