<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Relationships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleet_tracker', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('fleet_id')->nullable()->unsigned();
            $table->bigInteger('tracker_id')->nullable()->unsigned();
        });

        Schema::table('fleet_tracker', function (Blueprint $table) {
            $table->foreign('fleet_id')->references('id')->on('fleets')->onDelete('cascade');
            $table->foreign('tracker_id')->references('id')->on('trackers')->onDelete('cascade');
        });

        Schema::table('fleets', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('trackers', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('tracker_model_id')->references('id')->on('tracker_models')->onDelete('set null');
            $table->foreign('added_by_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trackers', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropForeign(['added_by_id']);
            $table->dropForeign(['tracker_model_id']);
        });

        Schema::table('fleets', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('fleet_tracker', function (Blueprint $table) {
            $table->dropForeign(['fleet_id']);
            $table->dropForeign(['tracker_id']);
        });

        Schema::dropIfExists('fleet_tracker');
    }
}
