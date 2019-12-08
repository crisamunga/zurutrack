<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FleetsTrackersRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('fleet_tracker', function (Blueprint $table) {
            $table->bigInteger('fleet_id')->nullable()->unsigned();
            $table->bigInteger('tracker_id')->nullable()->unsigned();

            $table->foreign('fleet_id')->references('id')->on('fleets')->onDelete('cascade');
            $table->foreign('tracker_id')->references('id')->on('trackers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fleet_tracker');
    }
}
