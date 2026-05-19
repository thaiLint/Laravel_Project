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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();

        // RELATIONS
        $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
        $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');

        // BOOKING INFO
        $table->date('check_in');
        $table->date('check_out');
        $table->time('check_in_time')->nullable();
        $table->time('check_out_time')->nullable();

        $table->integer('guests')->default(1);

        $table->string('status')->default('pending');
        // pending / confirmed / cancelled

        $table->decimal('total_price', 10, 2)->nullable();

        $table->text('notes')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
