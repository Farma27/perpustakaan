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
            $table->integer('id', 4)->autoIncrement()->unsigned();
            $table->string('name', 25);
            $table->string('username', 30)->unique();
            $table->string('email', 50)->unique();
            $table->text('address')->nullable();
            $table->string('password', 75);
            $table->rememberToken();
            $table->string('created_by')->nullable()->default('System');
            $table->string('updated_by')->nullable()->default('System');
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
