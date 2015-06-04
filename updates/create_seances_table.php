<?php namespace VM\MinuteMaker\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateSeancesTable extends Migration
{

    public function up()
    {
        Schema::create('vm_minutemaker_seances', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();

            $table->dateTime('date');
            $table->string('slug')->index();

            $table->integer('category_id')->unsigned()->index(); // BelongsTo one Category OR
            $table->integer('project_id')->unsigned()->index(); // BelongsTo one project
            $table->integer('order')->unsigned();

        });
    }

    public function down()
    {
        Schema::dropIfExists('vm_minutemaker_seances');
    }

}
