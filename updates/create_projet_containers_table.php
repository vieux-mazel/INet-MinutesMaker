<?php namespace VM\MinuteMaker\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateProjetContainersTable extends Migration
{

    public function up()
    {
        Schema::create('vm_minutemaker_projet_containers', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name'); // Childs projects will inherit this property
            $table->string('description'); // Childs projects will inherit this property
            $table->dateTime('last_used'); //touch everytimes a new project/seance is added to a project
            $table->integer('structure_id')->unsigned()->index(); // Namespace is the highest group
            $table->integer('category_id')->unsigned()->index(); //
            $table->integer('handled_cat_id')->unsigned()->index(); 
            #$table->integer('active_projet_id')->unsigned()->index(); // set active projet or semester

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vm_minutemaker_projet_containers');
    }

}
