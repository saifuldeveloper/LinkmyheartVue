<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('match_profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('looking_for')->nullable();
            $table->integer('from_age')->nullable();
            $table->integer('to_age')->nullable();
            $table->string('religion')->nullable();
            $table->string('education')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('family_status')->nullable();
            $table->string('location')->nullable();
            $table->string('height_from')->nullable();
            $table->string('height_to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_profiles');
    }
};
