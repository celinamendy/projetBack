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
        Schema::create('vehicules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('conducteur_id');
            $table->string('marque');
            $table->string('modele');
            $table->string('immatriculation');
            $table->integer('nombre_place');
            $table->string('Assurance_vehicule');
            $table->string('couleur');
            $table->string('photo');
            $table->timestamps();
            $table->foreign('conducteur_id')->references('id')->on('conducteurs')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};
