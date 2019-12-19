<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LinkedUsersRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('linked_users', function (Blueprint $table) {
            $table->foreign('linker_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('linkee_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('linked_users', function (Blueprint $table) {
            $table->dropForeign(['linker_id']);
            $table->dropForeign(['linkee_id']);
        });
    }
}
