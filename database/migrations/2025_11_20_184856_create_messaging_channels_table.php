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
        Schema::create('messaging_channels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')
                ->constrained()
                ->cascadeOnDelete();

            // ex: whatsapp, twilio, meta, etc.
            $table->string('provider')->default('whatsapp');

            // ex: "Canal Principal", "Pós-operatório", "Cobrança"
            $table->string('name');

            // número usado na API
            $table->string('phone_number')->nullable();

            // configs do provedor (tokens, webhook, etc.)
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
        Schema::dropIfExists('messaging_channels');
    }
};
