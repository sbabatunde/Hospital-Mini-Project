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
        Schema::create('doctors_appraisals', function (Blueprint $table) {
            $table->id();

            // Who is being appraised
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');

            // Who wrote the appraisal (admin)
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');

            // Review period (monthly, quarterly, yearly)
            $table->string('period'); // e.g., 'Q1 2025', 'June 2025'

            // Performance metrics
            $table->integer('professionalism')->nullable();   // 1-10
            $table->integer('punctuality')->nullable();
            $table->integer('patient_feedback')->nullable();
            $table->integer('case_handling')->nullable();

            // Overall comment
            $table->longText('appraisal_notes');

            // Optional attachments (e.g., reports, graphs)
            $table->json('attachments')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors_appraisals');
    }
};
