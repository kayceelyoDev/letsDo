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
        Schema::create('boxes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string("box_name");
            $table->string("box_description");
            $table->foreignId('users_id')->constrained()->onDelete('cascade');
            $table->enum('status',['deleted' , 'available'])->default('available');
            $table->enum('privacy',['Public' , 'Private'])->default('Public');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boxes');
    }
};
