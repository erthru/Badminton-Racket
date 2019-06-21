<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rackets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->integer("balance_point");
            $table->text("description");
            $table->longText("image");
            $table->bigInteger("brand_id")->unsigned();
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
        Schema::dropIfExists('rackets');
    }
}
