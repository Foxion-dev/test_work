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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('type_id');
            $table->float('amount', 20, 2);
            $table->timestamps();

            $table->index('user_id', 'transaction_user_idx');
            $table->foreign('user_id', 'transaction_user_fk')->on('users')->references('id')->onDelete('cascade');

            $table->index('type_id', 'transaction_type_idx');
            $table->foreign('type_id', 'transaction_type_fk')->on('transaction_types')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
