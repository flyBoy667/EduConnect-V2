<?php

use App\Models\Etudiant;
use App\Models\Module;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('etudiants_modules_notes', function (Blueprint $table) {
            $table->float('note_examen');
            $table->float('note_classe');
            $table->foreignIdFor(Etudiant::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Module::class)->constrained()->cascadeOnDelete();
            $table->primary(['etudiant_id', 'module_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
        Schema::table('notes', function (Blueprint $table) {
            $table->dropForeign(Etudiant::class);
            $table->dropForeign(Module::class);
        });
    }
};
