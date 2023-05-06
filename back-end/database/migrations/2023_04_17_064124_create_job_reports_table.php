<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'mysql';
    protected $table = 'job_reports';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_reports', function (Blueprint $table) {
            $table->id();

            // Define foreign keys
            $table->foreignId('job_id')->constrained('jobs', 'id')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('user_accounts', 'id')->onDelete('cascade');

            $table->string('reason');
            $table->softDeletes();
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
        Schema::dropIfExists('job_reports');
    }
};
