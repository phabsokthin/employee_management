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
        Schema::create('attandances', function (Blueprint $table) {
            $table->id('at_id');
            $table->unsignedBigInteger("emp_id");
            $table->foreign("emp_id")->references("emp_id")->on("employees")->onDelete('cascade')->onUpdate("cascade");
            $table->unsignedBigInteger("p_id");
            $table->foreign("p_id")->references("no")->on('positions')->onDelete("cascade")->onUpdate("cascade");
            $table->string("status");
            $table->string("description");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attancedances');
    }
};
