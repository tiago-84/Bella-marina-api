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
        Schema::create('sweepstakes', function (Blueprint $table) {
            $table->id();
            $table->uuid();

            $table->boolean('is_active')->default(true);
            $table->string('status')->default(\App\Models\Enums\SweepstakeStatus::DRAFT);

            $table->string('name');
            $table->string('slug')->unique();

            $table->string('image_card')->nullable();
            $table->string('image_page')->nullable();
            $table->longText('description')->nullable();

            $table->unsignedInteger('price');
            $table->unsignedInteger('minimum_amount')->default(1);

            $table->string('type')->default(\App\Models\Enums\SweepstakeType::AUTOMATIC);

            $table->dateTime('draw_date')->nullable();
            $table->dateTime('event_date')->nullable();

            $table->unsignedInteger('number_of_quotas')->default(100000);
            $table->unsignedInteger('remaining_blocks')->nullable();

            $table->boolean('affiliates')->default(true);
            $table->unsignedInteger('affiliates_percent')->default(30);
            $table->string('affiliates_type')->default(\App\Models\Enums\AffiliatesType::ALL);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sweepstakes');
    }
};
