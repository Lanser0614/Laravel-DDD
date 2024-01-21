<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('credits', function (Blueprint $table) {
            $table->uuid();
            $table->string('contract_number');
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('application_id');
            $table->unsignedInteger('merchant_id');
            $table->date('contract_date');
            $table->date('closed_at')->nullable();
            $table->unsignedBigInteger('application_amount');
            $table->unsignedBigInteger('initial_amount');
            $table->unsignedBigInteger('total_amount');
            $table->integer('duration');
            $table->integer('client_commission');
            $table->integer('partner_discount');
            $table->integer('vat');
            $table->date('first_payment_date');
            $table->string('status_key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credits');
    }
};
