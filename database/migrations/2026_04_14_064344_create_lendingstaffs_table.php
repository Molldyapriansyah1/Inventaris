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
        Schema::create('lendingstaffs', function (Blueprint $table) {
            $table->id();
            $table->string('borrowerName');
            $table->foreignId('item_id')->constrained()->onDelete('cascade');
            $table->integer('total');
            $table->string('keterangan')->nullable();
            $table->date('borrowDate'); 
            $table->enum('status', ['borrowed', 'returned'])->default('borrowed');
            $table->string('edited_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lendingstaffs');
    }
};
