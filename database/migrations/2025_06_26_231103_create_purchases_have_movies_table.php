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
        Schema::create('purchases_have_movies', function (Blueprint $table) {
            $table->foreignId('purchase_fk')->constrained(table: "purchases", column: "purchase_id");
            $table->foreignId('movie_fk')->constrained(table: "movies", column: "movie_id");
            $table->unsignedBigInteger("unit_price");
            $table->unsignedSmallInteger("queantity");
            $table->primary(["purchase_fk", "movie_fk"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases_have_movies');
    }
};
