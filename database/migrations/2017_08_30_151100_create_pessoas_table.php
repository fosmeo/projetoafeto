<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pessoas_nome');
            $table->string('pessoas_data_nasc') -> nullable();
            $table->integer('pessoas_idade') -> nullable();
            $table->text('pessoas_endereco') -> nullable();
            $table->string('pessoas_tel1') -> nullable();
            $table->string('pessoas_tel2') -> nullable();
            $table->string('pessoas_tel3') -> nullable();
            $table->text('pessoas_filhos') -> nullable();
            $table->string('pessoas_local_trabalho') -> nullable();
            $table->string('pessoas_tel_local_trabalho') -> nullable();
            $table->string('pessoas_sit_matrimonial') -> nullable();
            $table->string('pessoas_marido') -> nullable();
            $table->string('pessoas_prenatal') -> nullable();
            $table->string('pessoas_semana_gestacional') -> nullable();
            $table->string('pessoas_data_parto') -> nullable();
            $table->string('pessoas_tipo_parto') -> nullable();
            $table->string('pessoas_data_assist') -> nullable();
            $table->string('pessoas_acompanhante') -> nullable();
            $table->string('pessoas_email') -> nullable();
            $table->string('pessoas_imagem') -> nullable();
            $table->text('pessoas_obs') -> nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('clientes');
    }
}