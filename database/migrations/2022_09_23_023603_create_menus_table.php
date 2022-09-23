<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('website_id')->unsigned();
            $table->integer('parent_menu_id')->unsigned()->nullable();
            $table->string('title', 200);
            $table->integer('external_link')->default(0);
            $table->text('route');
            $table->integer('sort_order')->default(0);
            $table->integer('status')->default(0);
            $table->timestamps();

            // $table->enum('is_approved', array('0','1'))->default('0')->change();

            $table->foreign('website_id')
                ->references('id')
                ->on('web_sites')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
