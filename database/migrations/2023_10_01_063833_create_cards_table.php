<?php

use App\Models\User;
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
        Schema::create('cards', function (Blueprint $table) {
            $table->integer('id', 4)->autoIncrement()->unsigned();
            $table->integer('user_id')->unsigned()->index()->constrained()->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('number', 5)->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('batch')->default(1);
            $table->text('note')->nullable();
            $table->string('created_by')->nullable()->default('System');
            $table->string('updated_by')->nullable()->default('System');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
