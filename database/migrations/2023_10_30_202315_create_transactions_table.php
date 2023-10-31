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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid();

            $table->string('type');

            $table->morphs('object');

            $table->unsignedInteger('amount')->nullable();

            $table->string('provider_id')->nullable();
            $table->string('status')->default(\App\Models\Enums\TransactionStatus::CREATED);

            $table->morphs('responsible');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
