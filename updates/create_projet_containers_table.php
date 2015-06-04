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
            $table->integer('ns_id')->unsigned()->index(); //Category is a type of seance (Commission, Project etc.)
            $table->integer('category_id')->unsigned()->index(); //Category is a type of seance (Commission, Project etc.)

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vm_minutemaker_projet_containers');
    }

}
