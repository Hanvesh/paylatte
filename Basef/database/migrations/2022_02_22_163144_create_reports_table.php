<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('credit_id')->nullable()->constrained('credits');
            $table->foreignId('transaction_id')->nullable()->constrained('transactions');
            $table->foreignId('bill_id')->nullable()->constrained('bills');
            $table->foreignId('repayment_id')->nullable()->constrained('repayments');
            $table->foreignId('refund_id')->nullable()->constrained('refunds');
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
        Schema::dropIfExists('reports');
    }
}
