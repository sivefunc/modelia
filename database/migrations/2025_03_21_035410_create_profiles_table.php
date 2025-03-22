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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)
                  ->constrained()
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
            $table->foreignIdFor(\App\Models\Region::class)
                  ->constrained()
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate()
                  ->nullable();
            $table->foreignIdFor(\App\Models\Subregion::class)
                  ->constrained()
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate()
                  ->nullable();
            $table->foreignIdFor(\App\Models\Country::class)
                  ->constrained()
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate()
                  ->nullable();
            $table->foreignIdFor(\App\Models\State::class)
                  ->constrained()
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate()
                  ->nullable();
            $table->foreignIdFor(\App\Models\City::class)
                  ->constrained()
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate()
                  ->nullable();
            $table->double('balance')->default('0.0');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('total_uploads')->default('0');
            $table->integer('daily_uploads')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
