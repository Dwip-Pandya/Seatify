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
    Schema::create('tbl_seats', function (Blueprint $table) {
        $table->bigIncrements('seat_id');
        $table->unsignedBigInteger('event_id');
        $table->string('row', 50)->nullable();
        $table->string('number', 50)->nullable();
        $table->string('category', 100)->nullable();
        $table->decimal('price', 10, 2);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_seats');
    }
};
