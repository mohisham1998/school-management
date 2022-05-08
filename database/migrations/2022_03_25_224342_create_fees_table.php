<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table ->decimal('amount',8,2);
            $table -> string('year');
            $table -> longText('notes') -> nullable();
            $table -> foreignId('Classroom_id') -> references('id') -> on('classrooms') -> onDelete('cascade');
            $table -> foreignId('Grade_id') -> references('id') -> on('grades') -> onDelete('cascade');
            $table->integer('Fee_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fees');
    }
}
