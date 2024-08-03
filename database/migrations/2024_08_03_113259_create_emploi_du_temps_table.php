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
        Schema::create('emploi_du_temps', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(\App\Models\Filiere::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Module::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Professeur::class)->constrained()->cascadeOnDelete();
            $table->string('jour'); // 'Lundi', 'Mardi', etc.
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emploi_du_temps');
        Schema::table('emploi_du_temps', function (Blueprint $table) {
            $table->dropForeign('emploi_du_temps_filiere_id_foreign');
            $table->dropForeign('emploi_du_temps_module_id_foreign');
            $table->dropForeign('emploi_du_temps_professeur_id_foreign');
        });
    }
};
