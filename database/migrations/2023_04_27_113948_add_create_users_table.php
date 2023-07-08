<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('users', function (Blueprint $table) {
    $table->string('images')->default('Atlas.png')->change();
});
Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('images', 'image');//<-記述
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('images')->default('/storage/Atlas.png')->change();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('image', 'images');
        });
    }
}
