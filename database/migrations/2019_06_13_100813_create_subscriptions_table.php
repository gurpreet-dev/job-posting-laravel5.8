<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('plan_id')->nullable();
            $table->text('cc_number')->nullable();
            $table->text('transaction_id')->nullable();
            $table->double('amount_paid')->default(0);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_gateway')->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->integer('status')->default(0)->comment = "0 => Cancelled, 1 => Active, 2 => Expired";
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
        Schema::dropIfExists('subscriptions');
    }
}
