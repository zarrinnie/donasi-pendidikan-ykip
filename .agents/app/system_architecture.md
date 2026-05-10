# System Architecture Brief of Project

**Target Audience:** Frontend & Backend Developers, Software Architect
**Architecture Type:** Lightweight Monolith (Laravel Blade + Vanilla JS) integrated with an Action-Based Backend.

## 1. Communication Concepts & Main Paradigms

This project uses a highly optimized monolithic architecture within a single Laravel codebase to achieve lightning-fast load times for guest users and strict Separation of Concerns for the development team.

- **Public & Guest Frontend (Blade + Vanilla JS):** Laravel controllers return server-rendered Blade templates. Interactive elements (like the Coffee Cup tier selector and the Dynamic Summary Card) utilize modular Vanilla JavaScript to ensure zero-dependency, instantaneous interactions without the overhead of heavy frontend frameworks.
- **Admin Frontend (Livewire + Blade):** The control panel (viewing donor data, toggling verification emails) uses Laravel Livewire so developers can build complex, reactive administrative tables and forms without needing to build external APIs or write custom AJAX requests.

## 2. Backend Architecture (Action-Based Architecture)

To maintain clean code as the platform scales (especially regarding payment processing and donor tracking), the Laravel Backend side will not burden Controllers or Livewire components with business logic. The project adopts an Action-Oriented Architecture centered on the Single Responsibility Principle.

Main directory structure on the Laravel application side (`app/`):

- `app/Actions/` (Core Business Logic): PHP classes that have only one defined purpose (usually having a single method like `execute()` or `handle()`). Example: `ProcessGuestDonationAction`, `GenerateQrisCodeAction`, `ToggleWelcomeEmailStatusAction`. Controllers and Livewire components are only responsible for calling these actions.
- `app/DTOs/` (Data Transfer Objects): Used to encapsulate data sent from Requests before passing it into Actions. This ensures any data entering the logic layer is strongly typed, for example, `StoreGuestDonationDTO`.
- `app/Services/`: Used to house helper classes interacting with third-party services or common infrastructure logic. Example: `QrisPaymentGatewayService`, `EmailNotificationService`.
- `app/Livewire/`: Contains all visual Backend classes for the Admin Dashboard, which only function to gather data from models and call Action classes when an interface is triggered (e.g., the "Email Sent" checkbox is toggled).

**E. Background Tasks & Mail**
- **Scheduling:** Automated reminder emails must be handled via Laravel's Task Scheduling (`routes/console.php` or scheduled commands) running on a server cron job. 
- **Mail Configuration:** The system must utilize a secondary SMTP configuration specifically for automated system notifications to ensure the primary NGO email address is not flagged for automated sending.

## 3. Public Frontend Architecture (Feature-Based Architecture)

The frontend assets (in `resources/views/` and `resources/js/`) completely separate base/global code from business-specific domain code, preventing overlapping component dependencies (spaghetti code). The directory structure is strictly separated into two main pillars:

### 3.1. Core/ (Foundation & Agnostic)

Contains elements with no ties to any specific business logic. This part is pure UI infrastructure.

- `Components/`: Custom primitive Blade wrappers (e.g., `<x-button>`, `<x-card>`, `<x-input>`) for standardizing the coffee-shop UI aesthetic.
- `Scripts/`: Global vanilla JavaScript utility functions.
- `Styles/`: Global Tailwind CSS configurations and base styles.

### 3.2. Features/ (Isolated Business Domains)

All application functions (Donation Flow, Payment Processing, Admin Dashboard) are treated as standalone "mini-apps" within the `Features/` folder.
**Golden Rule:** Files within `Core/` must not call anything from `Features/`, and each feature folder must not import each other directly unless specifically defined.

Each business domain folder (e.g., `views/Features/DonationFlow/` or `js/Features/DonationFlow/`) has an internal structure:

- `components/`: Presentational Blade components relevant only to the feature (e.g., `coffee-tier-selector.blade.php`, `dynamic-impact-card.blade.php`).
- `scripts/`: Feature-specific Vanilla JS modules (e.g., `calculate-impact.js`, `handle-qris-polling.js`).
- `pages/`: The main entry points that assemble all elements into a complete page (e.g., `landing.blade.php`, `checkout.blade.php`).

## 4. Integrated Frontend Best Practices

- **State Management (Vanilla JS DOM State):** Because the public flow does not require a logged-in user session, heavy client-side state managers (like Redux or Zustand) are strictly forbidden. The state of the selected "Coffee Cup" and "Frequency" is managed entirely via DOM data attributes (`data-tier`, `data-frequency`) and calculated on-the-fly via Vanilla JS for the impact summary card.
- **Form Handling & Validation:** All public guest forms use native HTML5 validation paired with strict Laravel Form Requests on the backend. This ensures the user gets immediate feedback on the UI, but the database is completely protected by the server. Returning donor checks (email validation) happen seamlessly during this backend request phase.
- **QRIS Rendering:** The generated QRIS code image must be fetched securely from the backend and rendered directly into the DOM. Polling for payment success status should utilize a lightweight, dedicated JS interval function that pings a lightweight Laravel API route.