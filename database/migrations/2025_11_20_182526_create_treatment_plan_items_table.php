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
        Schema::create('treatment_plan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('treatment_plan_id')
                ->constrained('treatment_plans')
                ->cascadeOnDelete();

            $table->foreignId('procedure_id')
                ->nullable()
                ->constrained('procedures')
                ->nullOnDelete();

            $table->string('tooth')->nullable();   // dente 11, 36 etc.
            $table->string('surface')->nullable(); // M, D, O, etc. se quiser

            $table->decimal('price', 10, 2)->default(0);
            $table->string('status')->default('planned'); // planned, done, canceled

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatment_plan_items');
    }
};
