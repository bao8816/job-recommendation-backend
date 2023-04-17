<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'mysql';
    protected $table = 'posts';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            // Define foreign keys
            $table->foreignId('user_id')->constrained('user_accounts', 'id')->onDelete('cascade');
            $table->foreignId('cv_id')->constrained('cv', 'id')->onDelete('cascade');

            $table->string('title');
            $table->string('content');
            $table->integer('upvote');
            $table->integer('downvote');
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
        Schema::dropIfExists('posts');
    }
};
