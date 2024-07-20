<?php

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
        Schema::create('ressources', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Module::class)->constrained()->cascadeOnDelete();
            $table->string('nom');
            $table->string('fichier'); // type File
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ressources');
        Schema::table('ressources', function (Blueprint $table) {
            $table->dropForeignIdFor(Module::class);
        });
    }
};
