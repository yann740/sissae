<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('indicateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->decimal('valeur', 10, 2);
            $table->text('description')->nullable();
            $table->string('unite')->nullable(); // exemple : ppm, %, mg/L, etc.
            $table->date('date_releve')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indicateurs');
    }
};
