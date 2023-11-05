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
        Schema::create('companyinfo', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('about');
            $table->string('email', 100);
            $table->string('address', 255);
            $table->string('taxid', 13);
            $table->string('tel_1', 10);
            $table->string('tel_2', 10)->nullable();
            $table->string('fax', 10)->nullable();
            $table->string('logo', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companyinfo');
    }
};
