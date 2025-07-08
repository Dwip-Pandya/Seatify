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
    Schema::create('tbl_bookings', function (Blueprint $table) {
        $table->bigIncrements('booking_id');
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('event_id');
        $table->dateTime('booking_date');
        $table->decimal('total_amount', 10, 2);
        $table->string('pdf_path')->nullable();
        $table->enum('payment_status', ['success', 'fail']);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_bookings');
    }
};
