<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchemaTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->string('role')->nullable();
        });

        Schema::create('room_rentings', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('staff_id')->unsigned()->index();
            $table->string('note')->nullable();
            $table->string('status')->default('new');
            $table->timestamps();
        });

        Schema::create('room_renting_room', function(Blueprint $table){
            $table->increments('id');
            $table->integer('room_renting_id')->unsigned()->index();
            $table->integer('room_id')->unsigned()->index();
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->integer('price_per_day')->unsgined();
            $table->integer('price_per_hour')->unsgined();
            $table->timestamps();
        });
        
        Schema::create('services', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->integer('price')->unsigned();
            $table->timestamps();
        });
        
        Schema::create('room_renting_service', function(Blueprint $table){
            $table->increments('id');
            $table->integer('service_id')->unsigned()->index();
            $table->integer('room_renting_id')->unsigned()->index();
            $table->integer('price')->unsigned();
            $table->timestamps();
        });

        Schema::create('goods', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->integer('quantity')->unsigned();
            $table->integer('price')->unsigned();
            $table->timestamps();
        });

        Schema::create('room_renting_goods', function(Blueprint $table){
            $table->increments('id');
            $table->integer('good_id')->unsigned()->index();
            $table->integer('room_renting_id')->unsigned()->index();
            $table->integer('quantity')->unsigned();
            $table->integer('price')->unsigned();
            $table->timestamps();
        });

        Schema::create('rooms', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->integer('room_type_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::create('room_types', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->integer('price_per_day')->unsgined();   
            $table->integer('price_per_hour')->unsgined();
            $table->timestamps();
        });
    }

    public function down()
    {
        //
    }
}
