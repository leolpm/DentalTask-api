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
        Schema::create('ai_agents', function (Blueprint $table) {
            $table->id();
            // se você quiser ter agentes "globais", pode deixar nullable
            $table->foreignId('tenant_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Nome amigável: "Secretária", "Assistente Clínico"
            $table->string('name');

            // Tipo: secretary, clinical_assistant, billing_assistant, etc.
            $table->string('type');

            // prompt base do agente
            $table->text('system_prompt')->nullable();

            // configs extras (modelo, temperatura, funções habilitadas…)
            $table->json('config')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_agents');
    }
};
