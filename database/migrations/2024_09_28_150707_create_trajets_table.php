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
        // Assurez-vous que la table 'vehicules' existe avant de créer cette table.
        Schema::create('trajets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('conducteur_id');
            $table->string('point_depart');
            $table->string('point_arrivee');
            $table->timestamp('date_heure_depart');
            $table->enum('statut', ['en cours', 'terminer', 'annuler', 'confirmer']);
            $table->unsignedBigInteger('vehicule_id');
            $table->decimal('prix', 8, 2);
            $table->timestamps();

            // Relations avec les tables 'conducteurs' et 'vehicules'
            $table->foreign('conducteur_id')->references('id')->on('conducteurs')->onDelete('cascade');
            $table->foreign('vehicule_id')->references('id')->on('vehicules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trajets');
    }
};
