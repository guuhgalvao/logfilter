<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('xdate');
            $table->time('xtime');
            $table->string('logid');
            $table->string('sessionid');
            $table->string('type', 45);
            $table->string('subtype', 45);
            $table->string('user', 90)->nullable();
            $table->string('group', 90)->nullable();
            $table->string('srcip', 45)->nullable();
            $table->string('srcintf', 45)->nullable();
            $table->string('dstip', 45)->nullable();
            $table->string('dstintf', 45)->nullable();
            $table->string('hostname', 90)->nullable();
            $table->string('profile', 90)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
