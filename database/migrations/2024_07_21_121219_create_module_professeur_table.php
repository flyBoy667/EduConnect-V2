<?php

use App\Models\Module;
use App\Models\Professeur;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('module_professeur', function (Blueprint $table) {
            $table->foreignIdFor(Module::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Professeur::class)->constrained()->cascadeOnDelete();
            $table->primary(['module_id', 'professeur_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_professeur');
        Schema::table('module_professeur', function (Blueprint $table) {
            $table->dropForeign(Module::class);
            $table->dropForeign(Professeur::class);
        });
    }
};
