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
            $table->timestamp('added_on')->useCurrent();
            $table->timestamp('expires_on');
            $table->bigInteger('client_id')->nullable();
            $table->bigInteger('reseller_id')->nullable();
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
