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
            $table->string('title');
            $table->string('description');



            //if true any user can create a category in this structure (p.ex for commission/Project)
            $table->boolean('can_be_populated')->default('false');

            $table->boolean('project_handler')->default('false');
            // main structure categories are avaible in other structure/project to be linked
            $table->boolean('can_be_linked')->default('true');
            $table->boolean('is_main')->default('false');

            $table->string('slug')->index()->unique();

            $table->increments('id');
            $table->timestamps();
        });

        // Groups and structure link for belongsToMany relation with "Show"
        Schema::create('vm_minutemaker_structures_groups_show', function($table)
        {
            $table->integer('group_id')->unsigned();
            $table->integer('structure_id')->unsigned();
            $table->primary(['group_id', 'structure_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('vm_minutemaker_structures');
        Schema::dropIfExists('vm_minutemaker_structures_groups_show');
    }

}
