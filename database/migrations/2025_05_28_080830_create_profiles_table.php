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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('gender')->nullable();
            $table->text('desc')->nullable();
            $table->string('religion')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('nationality')->nullable();
            $table->string('present_address')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('hobby')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('education_level')->nullable();
            $table->string('institute_name')->nullable();
            $table->string('working_with')->nullable();
            $table->string('employer_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('duration')->nullable();
            $table->double('monthly_income')->nullable();
            $table->string('father_status')->nullable();
            $table->string('mother_status')->nullable();
            $table->integer('number_of_sibling')->nullable();
            $table->string('family_type')->nullable();
            $table->tinyInteger('status')->default(1);
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
