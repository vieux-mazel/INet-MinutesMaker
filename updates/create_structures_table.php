<?php namespace VM\MinuteMaker\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateStructuresTable extends Migration
{

    public function up()
    {
        Schema::create('vm_minutemaker_structures', function($table)
        {
            $table->engine = 'InnoDB';
            $table->string('name');
            $table->string('description');
            $table->string('slug')->index()->unique();

            $table->increments('id');
            $table->timestamps();
        });

        // Groups and structure link for belongsToMany relation with "Show"
        Schema::create('vm_minutemaker_struct_perms', function($table)
        {
            $table->integer('group_id')->unsigned();
            $table->integer('structure_id')->unsigned();
            $table->primary(['group_id', 'structure_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('vm_minutemaker_structures');
        Schema::dropIfExists('vm_minutemaker_struct_perms');
    }

}
