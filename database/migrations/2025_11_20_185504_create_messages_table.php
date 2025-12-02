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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('conversation_id')
                ->constrained('conversations')
                ->cascadeOnDelete();

            // quem "é" o remetente
            // patient, dentist, user, ai_agent, system
            $table->string('sender_type');

            // id do remetente (depende do sender_type)
            // ex: patient_id, dentist_id, user_id, ai_agent_id
            $table->unsignedBigInteger('sender_id')->nullable();

            // inbound (chegou do zap) / outbound (foi enviado)
            $table->string('direction')->default('inbound');

            $table->text('content')->nullable();

            // metadados: id do zap, status de entrega, tipo, anexos etc.
            $table->json('metadata')->nullable();

            $table->timestamps();

            $table->index(['tenant_id', 'conversation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
