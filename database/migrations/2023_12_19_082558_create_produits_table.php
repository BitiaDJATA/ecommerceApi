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
        Schema::create('Produits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categorie_id')->constrained('categories')->onDelete('cascade');
            $table->string('nom');
            $table->text('description');
            $table->integer('prix');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->boolean('visible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
