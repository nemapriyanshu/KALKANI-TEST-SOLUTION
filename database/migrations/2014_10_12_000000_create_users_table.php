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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('mobilenumber')->unique();
            $table->date('dateofbirth')->nullable();
            $table->text('address1');
            $table->text('address2')->nullable();
            $table->text('age')->nullable();
            $table->string('pincode');
            $table->string('city');
            $table->string('state');
            $table->enum('type', ['Home', 'Office']);
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
