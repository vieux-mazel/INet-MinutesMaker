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
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vm_minutemaker_projets');
    }

}
