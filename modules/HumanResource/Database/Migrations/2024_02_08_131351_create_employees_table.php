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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');

            /** Employee Status ID: 1 = Plantilla, 2 = Contructual, 3 = Job Order, 4 = Agency*/
            $table->unsignedBigInteger('status_id');
            $table->string('name');
            $table->string('employee_number')->unique();
            $table->string('position');
            $table->string('division');
            $table->string('unit');
            $table->string('mobile');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
