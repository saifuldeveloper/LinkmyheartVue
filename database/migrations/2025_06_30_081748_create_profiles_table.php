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
            $table->bigInteger('user_id');
            $table->string('i_am')->nullable();
            $table->string('account_for')->nullable();
            $table->tinyInteger('show_images')->default(0);
            $table->tinyInteger('show_contact')->default(0);
            $table->string('image')->nullable();
            $table->string('bio')->nullable();
            $table->text('desc')->nullable();
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('religion')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('location')->nullable();
            $table->bigInteger('age')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('nationality')->nullable();
            $table->string('present_address')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('smoking')->nullable();
            $table->string('drinking')->nullable();
            $table->string('hobby')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('education_level')->nullable();
            $table->string('profession')->nullable();
            $table->string('institute_name')->nullable();
            $table->string('education_year')->nullable();
            $table->string('designation')->nullable();
            $table->string('monthly_income')->nullable();
            $table->string('living_with_family')->nullable();
            $table->string('body_type')->nullable();
            $table->string('family_status')->nullable();
            $table->string('complexion')->nullable();
            $table->string('father_status')->nullable();
            $table->string('natinality')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->longText('additional_document')->nullable();
            $table->tinyInteger('verified')->default(0);
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
