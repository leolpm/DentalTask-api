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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('patient_id')
                ->constrained('patients')
                ->cascadeOnDelete();

            $table->foreignId('dentist_id')
                ->nullable()
                ->constrained('dentists')
                ->nullOnDelete();

            $table->foreignId('treatment_plan_item_id')
                ->nullable()
                ->constrained('treatment_plan_items')
                ->nullOnDelete();

            $table->dateTime('start_at');
            $table->dateTime('end_at')->nullable();

            $table->string('status')->default('scheduled'); // scheduled, confirmed, canceled, no_show, completed

            $table->string('source')->nullable(); // whatsapp, phone, in_person, site
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['tenant_id', 'start_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
