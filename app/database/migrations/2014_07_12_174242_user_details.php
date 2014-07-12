<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserDetails extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::dropIfExists('user_details');
        Schema::create('user_details', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('detail_id');
            $table->integer('user_id');
            $table->string('oauth_id', 20);
            $table->string('oauth_email');
            $table->string('oauth_name', 50);
            $table->string('oauth_given_name', 100);
            $table->string('oauth_family_name', 50);
            $table->text('oauth_link');
            $table->text('oauth_picture');
            $table->string('oauth_gender', 10);
            $table->string('oauth_updated', 15);
        
            $table->index('detail_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists('user_details');
    }
}
