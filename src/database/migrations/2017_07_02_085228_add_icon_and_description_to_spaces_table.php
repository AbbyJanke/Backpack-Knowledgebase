<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIconAndDescriptionToSpacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spaces', function(Blueprint $table) {
            $table->string('icon')->after('slug')->nullable();
            $table->text('description')->after('slug')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spaces', function(Blueprint $table) {
            $table->dropColumn('icon');
            $table->dropColumn('description');
        });
    }
}
