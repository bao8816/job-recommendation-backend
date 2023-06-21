<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'mysql';
    protected $table = 'applications';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->id();

            // Define foreign keys
            $table->foreignId('job_id')->constrained('jobs', 'id')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('user_accounts', 'id')->onDelete('cascade');

            $table->string('cv_path');
            $table->string('status')->default('Đang chờ');
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
        Schema::dropIfExists('applications');
    }
};
