<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVersioningColumnsToDownloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('downloads' , function(Blueprint $table){
           $table->string('version')->default('0.0.0');
           $table->string('author');
           $table->string('descr' , 300);
           $table->string('path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('downloads' , function(Blueprint $table) {
            $table->dropColumn('version');
            $table->dropColumn('author');
            $table->dropColumn('descr');
            $table->dropColumn('path');
        });
    }
}
