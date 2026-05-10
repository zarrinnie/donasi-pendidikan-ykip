<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonationPackage;
use Illuminate\Http\Request;

class DonationPackageController extends Controller
{
    public function index()
    {
        $packages = DonationPackage::orderBy('sort_order')->paginate(10);
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'is_custom' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'required|integer',
        ]);

        DonationPackage::create($validated);
        return redirect()->route('admin.packages.index')->with('status', 'Package created successfully.');
    }

    public function edit(DonationPackage $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, DonationPackage $package)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'is_custom' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'required|integer',
        ]);

        $package->update($validated);
        return redirect()->route('admin.packages.index')->with('status', 'Package updated successfully.');
    }

    public function destroy(DonationPackage $package)
    {
        $package->delete();
        return redirect()->route('admin.packages.index')->with('status', 'Package deleted successfully.');
    }
}
