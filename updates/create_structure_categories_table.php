<?php namespace VM\MinuteMaker\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateStructureCategoriesTable extends Migration
{

    public function up()
    {
        Schema::create('vm_minutemaker_structure_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->text('description');
            $table->boolean('can_hold_project');
            $table->string('slug')->index()->unique();
            $table->integer('structure_id')->unsigned()->index(); // BelongsTo one Structure

        });
        Schema::create('vm_minutemaker_cat_projet', function($table)
        {
            $table->integer('category_id')->unsigned();
            $table->integer('projet_id')->unsigned();
            $table->primary(['category_id', 'projet_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('vm_minutemaker_structure_categories');
        Schema::dropIfExists('vm_minutemaker_cat_projet'); //Join table
    }

}
