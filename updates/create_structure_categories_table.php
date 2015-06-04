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

            $table->boolean('can_hold_commission');

            $table->string('slug')->index()->unique();
            $table->integer('structure_id')->unsigned()->index(); // BelongsTo one Structure

        });

        Schema::create('vm_minutemaker_cat_notify', function($table)
        {
            $table->integer('group_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->primary(['group_id', 'category_id']);
        });

        Schema::create('vm_minutemaker_cat_watcher', function($table)
        {
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->primary(['user_id', 'category_id']);
        });


    }

    public function down()
    {
        Schema::dropIfExists('vm_minutemaker_structure_categories');
        Schema::dropIfExists('vm_minutemaker_cat_projet'); //Join table
        Schema::dropIfExists('vm_minutemaker_cat_notify'); //Join table
        Schema::dropIfExists('vm_minutemaker_cat_watcher'); //Join table


    }

}
