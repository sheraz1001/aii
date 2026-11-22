<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('assistant_name')->nullable();
            $table->string('phone_number')->nullable()->unique(); // the aii number calls arrive on, E.164
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->text('hours')->nullable();
            $table->text('services_and_prices')->nullable();
            $table->text('faqs')->nullable();
            $table->text('booking_rules')->nullable();
            $table->string('transfer_number')->nullable();
            $table->json('languages')->nullable();
            $table->string('stt_language', 16)->default('multi');
            $table->string('tts_voice_id')->nullable();
            $table->string('owner_email')->nullable();
            $table->text('extra_instructions')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->nullable()->constrained()->nullOnDelete();
            $table->string('caller_number')->nullable();
            $table->string('called_number')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->unsignedInteger('duration_seconds')->default(0);
            $table->json('transcript')->nullable();
            $table->json('messages')->nullable();
            $table->string('transferred_to')->nullable();
            $table->text('summary')->nullable();
            $table->timestamps();
            $table->index(['business_id', 'started_at']);
        });

        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('product')->nullable();
            $table->string('plan')->nullable();
            $table->text('message')->nullable();
            $table->string('source')->nullable();
            $table->string('ip', 45)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
        Schema::dropIfExists('calls');
        Schema::dropIfExists('businesses');
    }
};
