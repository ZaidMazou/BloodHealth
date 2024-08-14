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
        Schema::create('blood_pockets', function (Blueprint $table) {
            $table->id();
            $table->string('group_sanguin');
            $table->unsignedBigInteger('quantite');
            $table->unsignedBigInteger('capacite');
            $table->unsignedBigInteger('hopital');
            $table->foreign('hopital')->references('id')->on('hospitals')->onDelete('cascade');
            $table->date('date_collecte')->nullable();
            $table->date('date_expiration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_pockets');
    }
};
