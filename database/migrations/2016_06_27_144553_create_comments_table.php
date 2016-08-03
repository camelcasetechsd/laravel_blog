<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('comment');
            $table->timestamps();
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts');
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
        Schema::table('comments', function (Blueprint $table) {
            /** 
             * To drop a foreign key prefrence you should pass a string paramter to the method
             * contains "<tablename>_<foreignKeyName>_foreign"
             * or just pass an array contains only "<foreignKeyName>" and it will understand
             * and replace it with the right value   
             */
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropForeign(['post_id']);
            $table->dropColumn('post_id');
        });

        Schema::drop('comments');
    }

}
