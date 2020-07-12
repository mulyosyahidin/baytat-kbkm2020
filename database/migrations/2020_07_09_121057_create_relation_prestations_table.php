<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationPrestationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relation_prestations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('relation_id')->nullable();
            $table->string('event_name');
            $table->string('organizer')->nullable();
            $table->year('year')->nullable()->default(2020);
            $table->mediumText('description');
            $table->timestamps();

            $table->index('relation_id');

            $table->foreign('relation_id')->references('id')->on('relations')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relation_prestations');
    }
}
