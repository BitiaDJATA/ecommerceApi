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
            $table->boolean('is_commande')->default(false);
            $table->enumm('etat_commande')->default(0);
            $table->integer('quantite')->default(0);
            $table->integer('prix_total');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('Produit_id')->constrained('Produits')->onDelete('cascade');
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
