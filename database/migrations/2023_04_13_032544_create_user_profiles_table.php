<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'mysql';
    protected $table = 'user_profiles';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            // Define foreign keys
            $table->foreignId('id')->constrained('user_accounts', 'id')->onDelete('cascade');

            $table->string('full_name', 500)->default('Tên đầy đủ');
            $table->string('avatar', 2000)->default(env('DEFAULT_LOGO_URL', base_path('public/default_logo.png')));
            $table->string('about_me', 1000)->default('Giới thiệu bản thân')->nullable();
            $table->string('good_at_position', 1000)->nullable();
            $table->string('year_of_experience', 1000)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('address', 1000)->nullable();
            $table->string('email', 500)->nullable();
            $table->string('phone', 20)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
};
