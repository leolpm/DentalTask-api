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
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('patient_id')
                ->nullable()
                ->constrained('patients')
                ->nullOnDelete();

            $table->foreignId('dentist_id')
                ->nullable()
                ->constrained('dentists')
                ->nullOnDelete();

            $table->foreignId('channel_id')
                ->nullable()
                ->constrained('messaging_channels')
                ->nullOnDelete();

            // id da conversa no provedor (se tiver)
            $table->string('external_conversation_id')->nullable();

            // open, closed, archived, etc.
            $table->string('status')->default('open');

            $table->dateTime('last_message_at')->nullable();

            $table->timestamps();

            $table->index(['tenant_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
