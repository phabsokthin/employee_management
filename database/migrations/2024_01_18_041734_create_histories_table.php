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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("emp_id");
            $table->foreign("emp_id")->references("emp_id")->on("employees")->onDelete("cascade")->onUpdate("cascade");
            $table->string("position");
            $table->string("period");
            $table->string("work_place");
            $table->string("year");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
