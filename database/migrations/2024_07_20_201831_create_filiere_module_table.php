<?php

use App\Models\Filiere;
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
        Schema::create('filiere_module', function (Blueprint $table) {
            $table->foreignIdFor(Filiere::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Module::class)->constrained()->cascadeOnDelete();
            $table->primary(['filiere_id', 'module_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filiere_module');
        Schema::table('filiere_module', function (Blueprint $table) {
            $table->dropForeign(Filiere::class);
            $table->dropForeign(Module::class);
        });
    }
};
