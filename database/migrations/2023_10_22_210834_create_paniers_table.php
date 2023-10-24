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
        Schema::create('paniers', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->constrained(); // Si vous avez des utilisateurs enregistrés
            $table->enum('status',['ouvert', 'en attente', 'commandé'])->default('ouvert'); // Exemple : 'ouvert', 'en attente', 'commandé', etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paniers');
    }
};
