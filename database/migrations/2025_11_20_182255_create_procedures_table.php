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
        Schema::create('procedures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name'); // Implante unitário, Faceta, Alinhador 3D, etc.
            $table->string('code')->nullable(); // código interno ou TUSS

            $table->text('description')->nullable();

            $table->decimal('default_price', 10, 2)->nullable();
            $table->unsignedSmallInteger('default_duration_minutes')->nullable();

            $table->timestamps();

            $table->index(['tenant_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procedures');
    }
};
