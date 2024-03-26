<?php

use App\Models\Borrow;
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
        Schema::create('borrow_books', function (Blueprint $table) {
            $table->integer('id', 6)->autoIncrement()->unsigned();
            $table->integer('borrow_id')->unsigned()->index()->constrained()->foreign('borrow_id')->references('id')->on('borrows')->onDelete('cascade');
            $table->string('isbn', 13);
            $table->date('return_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrow_books');
    }
};
