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
        Schema::create('live_support_messages', function (Blueprint $table) {
            $table->id();
            $table->string('department')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('message');
            $table->bigInteger('number')->nullable();
            $table->string('marital_status')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->tinyInteger('seen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_support_messages');
    }
};
