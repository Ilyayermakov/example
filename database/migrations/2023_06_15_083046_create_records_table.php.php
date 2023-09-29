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
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->timestamps();


            $table->date('date');
            $table->time('time');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('procedure');
            $table->string('price');
            $table->string('telephon')->nullable();
            $table->string('discount')->default(0);
            $table->integer('profile_id');
            $table->boolean('active')->default(1);
            $table->text('comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
