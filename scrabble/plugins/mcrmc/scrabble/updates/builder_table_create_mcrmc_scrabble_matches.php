<?php namespace Mcrmc\Scrabble\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMcrmcScrabbleMatches extends Migration
{
    public function up()
    {
        Schema::create('mcrmc_scrabble_matches', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('player1')->nullable();
            $table->integer('player2')->nullable();
            $table->integer('player1_score')->nullable();
            $table->integer('player2_score')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mcrmc_scrabble_matches');
    }
}
