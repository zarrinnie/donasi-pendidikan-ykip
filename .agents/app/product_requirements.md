# Product Requirements Document (PRD): Coffee-Themed NGO Donation Platform (YKIP)

**Platform:** Web Application (Responsive)
**Tech Stack:** Laravel 11 (Backend Core), PHP 8.4, MySQL (Database), Nginx (Web Server), Blade Templates (Public Frontend), Vanilla JavaScript (Dynamic UI), Laravel Breeze (Admin Scaffolding).

## 1. Product Overview

This application is an interactive web platform serving as a frictionless donation portal for the YKIP nonprofit organization. It utilizes a creative "coffee shop" theme ("Secangkir Kopi untuk Pendidikan") to make the guest-checkout donation process feel warm, familiar, and highly accessible, while providing a secure backend administrative panel for NGO staff to track and manage donor communications.

### Project Objectives:

- **Frictionless Donating:** Eliminate the barrier of account creation by offering a seamless guest-checkout experience modeled after ordering a cup of coffee.
- **Real-Time Impact Feedback:** Ensure donors understand their exact commitment through a dynamic summary card that translates their monetary donation into tangible, real-world educational impact.
- **Instant Transactions:** Facilitate immediate, cashless payments via a generated QRIS code upon order submission.
- **Manual Workflow Tracking:** Provide a secure administrative dashboard that allows NGO staff to view incoming donor data and meticulously track the status of manual verification emails.

## 2. User Personas & Roles

### A. Guest User (Donor / Unauthenticated)

- **Description:** General public, prospective donors, returning donors, and philanthropists.
- **Permissions:** View Landing Page, interact with the donation configuration form, view dynamic summaries, and access the QRIS payment page.
- **Main Tasks:** Learn about the NGO, select a donation amount and frequency, fill out basic guest details, and complete payment via QRIS.

### B. NGO Admin (Staff / Trackers)

- **Description:** YKIP staff members managing daily donor relations.
- **Permissions:** Access to the secure Backend dashboard.
- **Main Tasks:** View the table of recent donations (Name, Email, Date), and manually toggle the "Verification Email Sent" status after sending personalized emails to donors.

## 3. System Workflows

### Flow 1: Interactive "Coffee Order" Checkout (Guest Flow)

1. Users are greeted by the Landing Page featuring a brief explanation of YKIP, a link to the official site, and a "Start an Order" Call to Action.
2. Users enter the Donation Page.
3. Users select their donation tier visually represented as a "Cup Size" (Rp 50.000, Rp 75.000, Rp 100.000, or Custom Amount).
4. Users select their donation frequency (3 Bulan, 6 Bulan, 1 Tahun).
5. The system immediately updates a **Dynamic Impact Card** on the right side of the screen.
6. Users fill out the Guest Order form (Nama, Jenis Kelamin, Pekerjaan, E-Mail, No Telp) and submit.
7. **(Returning Donor Check):** The backend checks if the email already exists in the `donors` table. If yes, it links the new order to the existing donor. If no, it creates a new donor profile.
8. The system directs users to a Payment Page displaying a generated QRIS code for the exact amount.
9. After successful payment, users are directed to a Thank You/Receipt page.

### Flow 2: Donor Tracking & Verification (Admin Flow)

1. NGO Admin logs into the secure backend portal.
2. Admin navigates to the Donor Tracking table.
3. The system displays a list of all guest donations, sortable by the `created_at` timestamp.
4. The Admin copies a donor's email address and sends a verification email manually.
5. The Admin clicks the toggle/checkbox for "Verification Email Sent" on that donor's row.
6. The system captures this action, utilizing the `updated_at` timestamp for auditing.

## 4. Detailed Feature Specs

- **Donation Tier Selector:** Interactive UI buttons representing donation amounts (50k, 75k, 100k, Custom) acting as the primary input.
- **Dynamic Impact Summary Card (Impact Equivalence):** A client-side reactive component (powered by JavaScript) anchored on the right layout. As the user clicks different tiers and frequencies, the card must dynamically update to display:
    1. A relevant PNG illustration (e.g., an open book, a backpack, a pair of shoes).
    2. A brief text description of the real-world impact of that specific donation combination.
- **Smart Guest Checkout (Returning Donors):** The system must handle repeat donations gracefully. If an order is submitted with an email that already exists, it must seamlessly attach the new `donation` record to the existing `donor` ID without forcing a login.
- **Automated Reminder Notifications:** A backend scheduled task (cron job) will monitor the `next_reminder_date` on donations. When triggered, it will send an automated reminder email using a dedicated, separate system email address (e.g., noreply@...) to protect the official YKIP sender reputation.
- **QRIS Code Generator:** Integration that takes the finalized order amount and generates a valid, scannable QRIS code.
- **Verification Status Toggle:** A database-backed UI toggle in the admin table allowing staff to change the boolean `is_welcome_email_sent` state.