<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_urls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('url');
            $table->string('verification_key');
            $table->string('verification_status', 50)->default('pending');
            $table->integer('verified_by_id')->nullable();
            $table->date('verification_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default('1');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('web_urls');
    }
}
