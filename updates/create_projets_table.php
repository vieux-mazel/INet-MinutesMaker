<?php namespace VM\MinuteMaker\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateProjetsTable extends Migration
{

    public function up()
    {
        Schema::create('vm_minutemaker_projets', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->dateTime('date');
            $table->dateTime('start');
            $table->dateTime('end');

            $table->integer('container_id')->unsigned()->index()->nullable(); //Define the project leader
            $table->integer('leader_id')->unsigned()->index()->nullable(); //Define the project leader
            $table->integer('bilan_id')->unsigned()->index()->nullable(); //Define the attached bilan
            $table->integer('category_id')->unsigned()->index()->nullable(); //Define the attached bilan

            $table->enum('status', ['active', 'upcoming', 'done'])->default('active');
            #$table->enum('type', ['commission', 'projet']);
            $table->timestamps();

        });
        Schema::create('vm_minutemaker_projet_member', function($table)
        {
            $table->integer('user_id')->unsigned();
            $table->integer('projet_id')->unsigned();
            $table->primary(['user_id', 'projet_id']);
        });
        Schema::create('vm_minutemaker_projet_bilan', function($table)
        {
            $table->integer('point_id')->unsigned();
            $table->integer('projet_id')->unsigned();
            $table->primary(['point_id', 'projet_id']);
        });



    }

    public function down()
    {
        Schema::dropIfExists('vm_minutemaker_projets');
        Schema::dropIfExists('vm_minutemaker_projet_member');
        Schema::dropIfExists('vm_minutemaker_projet_bilan');

    }

}
