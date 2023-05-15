<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'mysql';
    protected $table = 'jobs';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->id();

            // Define foreign keys
            $table->foreignId('employer_id')->constrained('employer_accounts', 'id')->onDelete('cascade');

            $table->string('title');
            $table->string('description', 10000);
            $table->integer('min_salary');
            $table->integer('max_salary');
            $table->integer('recruit_num');
            $table->string('position');
            $table->integer('upvote')->default(0);
            $table->integer('downvote')->default(0);
            $table->string('experience');
            $table->date('deadline');
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
        Schema::dropIfExists('jobs');
    }
};