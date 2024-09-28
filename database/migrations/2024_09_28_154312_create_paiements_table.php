<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reservation_id');
            $table->decimal('montant', 8, 2);
            $table->timestamp('date_paiement');
            $table->timestamps();
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};