<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('event_id');
            $table->string('event_title');
            $table->text('event_description');
            $table->string('event_image');
	        $table->date('event_date');
	        $table->time('event_time');
            $table->string('event_location');
            $table->integer('event_user');
            $table->integer('event_state');
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
        Schema::dropIfExists('events');
    }
}
