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
        Schema::create('patient_notes', function (Blueprint $table) {
            $table->id();
            // Multi-tenant
            $table->foreignId('tenant_id')
                ->constrained()
                ->cascadeOnDelete();

            // Paciente a quem a nota pertence
            $table->foreignId('patient_id')
                ->constrained('patients')
                ->cascadeOnDelete();

            // Opcional: nota ligada a um dentista específico
            $table->foreignId('dentist_id')
                ->nullable()
                ->constrained('dentists')
                ->nullOnDelete();

            // Quem criou: usuário humano (secretária, dono da clínica etc.)
            $table->foreignId('created_by_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Se a nota veio da IA (ex: Observação feita pela Secretária/Assistente Clínico)
            $table->foreignId('ai_agent_id')
                ->nullable()
                ->constrained('ai_agents')
                ->nullOnDelete();

            // Opcional: vincular à mensagem do WhatsApp que originou a nota
            $table->foreignId('message_id')
                ->nullable()
                ->constrained('messages')
                ->nullOnDelete();

            // Opcional: vincular à consulta específica
            $table->foreignId('appointment_id')
                ->nullable()
                ->constrained('appointments')
                ->nullOnDelete();

            // Categoria da nota para filtros
            // Ex: clinical, behavior, medication, family, finance, profile
            $table->string('category')->nullable();

            // Título curto da nota (opcional)
            $table->string('title')->nullable();

            // Conteúdo principal da anotação
            $table->text('content');

            // Tags livres pra filtro (array de strings)
            // Ex: ["medroso", "tem_filhos", "atrasou_medicação"]
            $table->json('tags')->nullable();

            // Metadados estruturados (pra IA usar melhor)
            // Ex: {"has_children": true, "children_count": 2}
            $table->json('metadata')->nullable();

            // Ex: fixar nota importante no topo
            $table->boolean('is_pinned')->default(false);

            // Se um dia você quiser mostrar algumas notas no portal do paciente
            $table->boolean('visible_to_patient')->default(false);

            $table->timestamps();

            $table->index(['tenant_id', 'patient_id', 'category']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_notes');
    }
};
