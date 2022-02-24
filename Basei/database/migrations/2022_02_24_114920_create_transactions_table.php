<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('credit_id')->nullable()->constrained('credits');
            $table->foreignId('vendor_id')->nullable()->constrained('vendors');
            $table->Integer('credit_limit');
            $table->foreign('credit_limit')->references('credit_limit')->on('credits');
            $table->Integer('item_cost');
            $table->foreign('item_cost')->references('item_cost')->on('vendors');
            $table->integer('transaction_amount')->unique();
            $table->boolean('transaction_status');
            $table->timestamp('transaction_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
