<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LaboratoryJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratory_job_types', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('flagstate')->default(true);

            $table->string('value');
        });
        Schema::create('laboratory_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('flagstate')->default(true);
            
            /**
             * Informacion basica para 
             * registrar el trabajo encargado
             */
            $table->string('description', 300); // titulo
            $table->text('observation'); // observaciones
            $table->dateTime('charge'); // fecha de encargo
            $table->dateTime('deliver'); // fecha de entrega

            // estos campos son para laboratorio de odontologia
            $table->string('clinic_patient_name', 300);
            $table->string('clinic_doctor_name', 300);

            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('laboratory_job_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laboratory_jobs');
        Schema::dropIfExists('laboratory_job_types');
    }
}
