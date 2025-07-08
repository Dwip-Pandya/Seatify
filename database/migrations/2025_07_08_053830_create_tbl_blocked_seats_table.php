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
    Schema::create('tbl_blocked_seats', function (Blueprint $table) {
        $table->bigIncrements('blocked_seat_id');
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('seat_id');
        $table->unsignedBigInteger('event_id');
        $table->dateTime('blocked_at');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_blocked_seats');
    }
};
