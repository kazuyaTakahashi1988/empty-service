<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	for ($i=0; $i < 30; $i++) {
	        DB::table('posts')->insert([
	            [
	              'user_id' => 1,
	              'category_id' => 1,
	              'title' => 'hoge【 '.$i.' 】',
	              'content' => 'test'.$i.'test'.$i.'test'.$i.'test'.$i,
                  'image' => 'dOu7rdEALGLspTSxWXbT5l4aM5PmByk6MFgn2ybp.jpeg'
	            ]
	        ]);
        }
    }
}
