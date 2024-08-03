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
        Schema::create('q_c_m_s', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(\App\Models\Module::class)->constrained()->cascadeOnDelete();
            $table->string('theme');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('q_c_m_s');
        Schema::table('q_c_m_s', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Module::class);
        });
    }
};
