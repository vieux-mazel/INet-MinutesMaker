<?php namespace VM\MinuteMaker\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreatePointsTable extends Migration
{

    public function up()
    {
        Schema::create('vm_minutemaker_points', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Fields set at creation
            $table->string('title');
            $table->integer('order')->unsigned();
            $table->integer('seance_id')->unsigned()->index(); // BelongsTo one Seance
            $table->boolean('is_tracked')->default(false);
            // Fields set manualy by user
            $table->text('pv')->nullable();

            $table->boolean('has_warning')->default(false);
            $table->text('warning_text')->nullable();

            // Automatic fields for discussion tracking
            $table->string('slug')->index()->unique();
            $table->integer('first_id')->unsigned()->index()->nullable();
            $table->dateTime('last_modification')->nullable();
            $table->integer('last_modification_by')->unsigned()->index()->nullable();

            $table->timestamps();
            // Automatic set depend on link
            $table->enum('status', ['new', 'done', 'dismiss', 'reported'])->default('new');



        });
    }

    public function down()
    {
        Schema::dropIfExists('vm_minutemaker_points');
    }

}
