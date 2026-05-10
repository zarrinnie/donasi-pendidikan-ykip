# Admin Dashboard & Donor Tracking Table - Technical Specification

This document outlines the technical implementation plan for the Admin Dashboard and Donor Tracking interface, utilizing Laravel Breeze for authentication and Livewire for dynamic table interactions.

## Proposed Architecture & Changes

### 1. Authentication (Laravel Breeze)
- **Scaffolding:** Laravel Breeze (Blade stack) is configured. The `/dashboard` route is protected by the `auth` and `verified` middlewares.
- **Views:** The standard Breeze dashboard layout will be customized with coffee-themed styling.

### 2. Backend Logic (Actions)
- **Action:** `app/Actions/ToggleWelcomeEmailStatusAction.php`
  - Accepts a `Donation` model (or ID).
  - Toggles the `is_welcome_email_sent` boolean.
  - Updates the `updated_at` timestamp implicitly when saved.

### 3. The Livewire Dashboard
- **Component:** `Admin/DonorTrackingTable`
- **Backend (`app/Livewire/Admin/DonorTrackingTable.php`):**
  - Uses `WithPagination`.
  - Queries `Donation::with('donor')->latest()->paginate(10)`.
  - Implements `toggleWelcomeEmail(int $donationId, ToggleWelcomeEmailStatusAction $action)`.
- **Frontend (`resources/views/livewire/admin/donor-tracking-table.blade.php`):**
  - Renders a Tailwind CSS data table.
  - Displays: Date, Donor Name, Email, Phone, Donation Tier, Frequency, and Amount.
  - Checkbox toggle wired to `toggleWelcomeEmail` with visual feedback (success message).

### 4. Styling & Integration
- Update `resources/views/dashboard.blade.php` to embed `<livewire:admin.donor-tracking-table />`.
- Apply the coffee-themed UI colors (Coffee Brown: `#3E2723`, Cream: `#FDFBF7`, Caramel: `#D4A373`).

## Execution
@developer will proceed immediately with generating the Livewire component and applying the code.
