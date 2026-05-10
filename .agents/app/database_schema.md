# Database Schema: Coffee-Themed NGO Donation Platform (YKIP)

## 1. ADMIN & STAFF MANAGEMENT

### `users`
This table handles the authentication and role management for the secure administrative dashboard. 

| Field | Type | Attributes | Notes |
| :--- | :--- | :--- | :--- |
| `id` | `int` | **PK**, Auto Increment | |
| `name` | `varchar` | | |
| `email` | `varchar` | Unique | |
| `password` | `varchar` | | |
| `role` | `varchar` | Default: `'Staff'` | ENUM: Super Admin, Staff |
| `created_at` | `timestamp` | | |
| `updated_at` | `timestamp` | | |

---

## 2. DONORS & TRANSACTIONS

### `donors`
Stores the personal information of the people making donations. Even though they do not log in, their data is saved here so the NGO can maintain a relationship with them.

| Field | Type | Attributes | Notes |
| :--- | :--- | :--- | :--- |
| `id` | `int` | **PK**, Auto Increment | |
| `name` | `varchar` | | |
| `gender` | `varchar` | | ENUM: Laki-laki, Perempuan |
| `occupation` | `varchar` | | |
| `email` | `varchar` | Unique | |
| `phone` | `varchar` | | |
| `created_at` | `timestamp` | | |
| `updated_at` | `timestamp` | | |

### `donations`
Acts as the central ledger for all coffee-themed transactions and tracks the NGO's administrative workflow (like sending welcome emails).

| Field | Type | Attributes | Notes |
| :--- | :--- | :--- | :--- |
| `id` | `int` | **PK**, Auto Increment | |
| `donor_id` | `int` | **FK**, Not Null | References `donors.id` |
| `donation_tier`| `varchar` | | ENUM: Small, Regular, Large, Custom |
| `amount` | `int` | | Exact monetary value |
| `frequency` | `varchar` | | ENUM: 3 Bulan, 6 Bulan, 1 Tahun |
| `payment_status`| `varchar` | Default: `'Pending'`| ENUM: Pending, Success, Failed |
| `tracking_code`| `varchar` | Unique | e.g., small1, regular25 |
| `is_welcome_email_sent` | `boolean` | Default: `false` | Checked manually by Admin |
| `next_reminder_date` | `date` | Nullable | For automated reminder pings |
| `receipt_number` | `varchar` | Unique | e.g., REC-0001 |
| `created_at` | `timestamp` | | |
| `updated_at` | `timestamp` | | |

> **Relationship Note:** A donor can have many donations (One-to-Many). The `donations.donor_id` acts as the foreign key linking back to `donors.id`.

