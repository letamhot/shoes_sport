<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_bill')->unsigned()->nullable();
            $table->foreign('id_bill')->references('id')->on('bills')->onDelete('cascade');
            $table->integer('id_product')->unsigned()->nullable();
            $table->foreign('id_product')->references('id')->on('product')->onDelete('cascade');
            $table->string('name_product')->nullable();
            $table->integer('size')->nullable();
            $table->integer('quantity')->comment('Số lượng')->nullable();
            $table->double('unit_price')->nullable();
            $table->double('total_price')->nullable();
            $table->boolean('status')->nullable()->default(0);
            $table->string('user_created')->nullable();
            $table->string('user_updated')->nullable();
            $table->string('user_deleted')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills_detail');
    }
}
