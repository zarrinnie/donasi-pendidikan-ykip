<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->constrained()->onDelete('cascade');
            $table->string('donation_tier'); // Small, Regular, Large, Custom
            $table->integer('amount');
            $table->string('frequency'); // 3 Bulan, 6 Bulan, 1 Tahun
            $table->string('payment_status')->default('Pending'); // Pending, Success, Failed
            $table->string('tracking_code')->unique();
            $table->boolean('is_welcome_email_sent')->default(false);
            $table->date('next_reminder_date')->nullable();
            $table->string('receipt_number')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
