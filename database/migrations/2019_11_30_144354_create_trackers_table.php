<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('serial');
            $table->string('model');
            $table->string('state');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->datetime('added_on')->useCurrent();
            $table->datetime('expires_on');
            $table->bigInteger('client_id')->nullable()->unsigned();
            $table->bigInteger('added_by_id')->nullable()->unsigned();
            $table->timestamps();
        });

        Schema::table('trackers', function (Blueprint $table) {
            $table->index('serial');
            $table->index('model');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trackers');
    }
}
