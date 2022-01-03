<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results_itens', function (Blueprint $table) {
            $table->engine = "InnoDB"; 
            $table->id();
            $table->integer('result_id')->nullable()->unsigned()->comment('Id do Result relacionado');;
            $table->integer('topic_id')->nullable()->unsigned()->comment('Id do Topico respondido no momento de salvar o registro');;
            $table->longText('title')->nullable()->comment('Descrição do tópico no momento de salvar o registro');
            $table->longText('text')->nullable()->comment('Descrição do texto do tópico no momento de salvar o registro');
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
        Schema::dropIfExists('results_itens');
    }
}
