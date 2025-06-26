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
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->id();
            // Who the history belongs to
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');

            // Which doctor authored it (nullable for historical imports)
            $table->foreignId('doctor_id')->nullable()->constrained('users')->onDelete('set null');

            // Title/brief summary
            $table->string('title');

            // Detailed notes (symptoms, diagnosis, treatment, etc.)
            $table->longText('description');

            // Optional: diagnosis, medications, follow-up
            $table->string('diagnosis')->nullable();
            $table->text('medications')->nullable();
            $table->date('next_visit')->nullable();

            // Attachments (like scans or lab reports)
            $table->json('attachments')->nullable(); // store file paths or URLs

            // Audit trail
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_histories');
    }
};
