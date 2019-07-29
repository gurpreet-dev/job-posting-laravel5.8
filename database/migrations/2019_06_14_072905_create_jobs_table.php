<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->string('title')->nullable();
            $table->string('email')->nullable();
            $table->string('location')->nullable();
            $table->string('state')->nullable();
            $table->string('type')->nullable();
            $table->integer('vacancies')->default(0);
            $table->longText('description')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('view_image')->nullable();
            $table->string('interview_thumbnail')->nullable();
            $table->string('interview_video')->nullable();
            $table->bigInteger('hired_user')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
