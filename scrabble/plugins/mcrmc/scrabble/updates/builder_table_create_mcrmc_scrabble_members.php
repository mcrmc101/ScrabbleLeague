<?php namespace Mcrmc\Scrabble\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMcrmcScrabbleMembers extends Migration
{
    public function up()
    {
        Schema::create('mcrmc_scrabble_members', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('active')->default(1);
            $table->dateTime('date_joined')->nullable();
            $table->integer('wins')->nullable();
            $table->integer('losses')->nullable();
            $table->integer('draws')->nullable();
            $table->integer('matches_played')->nullable();
            $table->integer('average')->nullable();
            $table->text('matches')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mcrmc_scrabble_members');
    }
}
