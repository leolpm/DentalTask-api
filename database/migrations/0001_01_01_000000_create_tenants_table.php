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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('trade_name')->nullable(); // Nome fantasia
            $table->string('document')->nullable(); // CNPJ ou CPF
            $table->string('subdomain')->nullable()->unique(); // ex: consultorio-saude-bucal
            $table->string('whatsapp_number')->nullable(); // Número de WhatsApp para contato
            $table->string('email')->unique(); // Email de contato
            $table->string('logo_path')->nullable(); // Caminho para o logo do tenant na storage
            $table->string('status')->default('active'); // active, suspended, etc.
            $table->string('phone')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('plan')->default('trial'); // Plano do tenant
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
