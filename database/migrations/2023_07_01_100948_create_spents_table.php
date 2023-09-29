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
        Schema::create('spents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('profile_id');
            $table->date('date');
            $table->string('name');
            $table->decimal('quantity', 15, 3);
            $table->decimal('price', 12, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spents');
    }
};
