<?php

use App\Models\Etudiant;
use App\Models\PersonnelAdministratif;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Etudiant::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PersonnelAdministratif::class)->constrained()->cascadeOnDelete();
            $table->float('montant');
            $table->string('type');
            $table->date('date');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
        Schema::table('paiements', function (Blueprint $table) {
            $table->dropForeignIdFor(Etudiant::class);
            $table->dropForeignIdFor(PersonnelAdministratif::class);
        });
    }
};
