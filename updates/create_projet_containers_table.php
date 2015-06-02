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

            $table->string('title');
            $table->integer('category_id')->unsigned()->index(); //Category is a type of seance (Commission, Project etc.)


            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vm_minutemaker_projet_containers');
    }

}
