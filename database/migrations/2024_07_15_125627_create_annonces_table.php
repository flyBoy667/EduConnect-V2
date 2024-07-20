<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('annonces', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('titre');
            $table->text('contenu');
            $table->date('dateDebut');
            $table->date('dateFin');
            $table->string('image')->nullable();
            $table->foreignIdFor(\App\Models\User::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonces');
        Schema::table('annonces', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\User::class);
        });
    }
};
