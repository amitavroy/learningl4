<?php
use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('blog_post');
        
        Schema::create('blog_post', function ($table)
        {
            $table->engine = 'InnoDB';
            
            $table->increments('blog_id');
            $table->string('blog_title');
            $table->text('blog_summary');
            $table->text('blog_body');
            $table->integer('user_id')->unsigned();
            $table->integer('num_of_comments')->default(0);
            $table->integer('status')->default(0);
            $table->timestamps();
        });
        
        $dt =  new DateTime;
        $created = $dt->format('m-d-y H:i:s');
        
        DB::table('blog_post')->insert(array(
            'blog_title' => 'My first blog post',
            'blog_summary' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam aliquam ullamcorper placerat. Nam et libero sapien. Phasellus bibendum eros et nisl accumsan fringilla.',
            'blog_body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam aliquam ullamcorper placerat. Nam et libero sapien. Phasellus bibendum eros et nisl accumsan fringilla. Phasellus sed enim quis sem sodales viverra. Sed ac diam laoreet, laoreet purus at, consectetur mauris. Curabitur et auctor urna. Quisque commodo enim eu orci laoreet, nec mattis odio mattis. Curabitur varius, magna nec imperdiet semper, nisl velit consectetur dolor, ut pretium risus turpis vitae lacus. Quisque non consectetur nibh. Praesent vehicula consectetur leo, fringilla luctus massa sagittis quis. Aliquam erat volutpat. In consequat tellus non nibh hendrerit, in congue nibh molestie. Nullam in urna tellus.',
            'user_id' => 1,
            'status' => 1,
            'created_at' => $created,
            'updated_at' => $created,
        ));
        
        $secondBlogTime = strtotime('+5 days');
        $dateFormatted = date('m-d-y H:i:s', $secondBlogTime);
        DB::table('blog_post')->insert(array(
            'blog_title' => 'My second blog post',
            'blog_summary' => 'Donec porttitor sapien est, sed ullamcorper leo dignissim vitae. Pellentesque convallis justo hendrerit, imperdiet neque non, fermentum eros.',
            'blog_body' => 'Donec porttitor sapien est, sed ullamcorper leo dignissim vitae. Pellentesque convallis justo hendrerit, imperdiet neque non, fermentum eros. Donec vitae nunc at mauris semper accumsan ut eget eros. Pellentesque gravida, leo vel scelerisque posuere, arcu lectus euismod nisi, vel mollis arcu est a ligula. Duis egestas tellus eu vehicula imperdiet. Donec interdum, leo porta tincidunt vestibulum, elit nisl dapibus nulla, vel euismod odio mauris et metus. Duis pharetra mauris sed commodo cursus. Praesent nec lectus ligula. In vestibulum libero eu posuere lobortis. Praesent pulvinar dictum lectus et accumsan. Vestibulum non diam nisl.',
            'user_id' => 1,
            'status' => 1,
            'created_at' => $dateFormatted,
            'updated_at' => $dateFormatted,
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_post');
    }
}