<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class PostsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new DateTime('now');
        $articles = array(
            array(
                'title' => 'First Article',
                'author_id' => User::find(2)->id,
                'summary' => 'First Article\'s summary',
                'body' => 'First Article\'s body First Article\'s body First Article\'s body \n
                    First Article\'s body First Article\'s body First Article\'s body First Article\'s body \n
                    First Article\'s body First Article\'s body ',
                'image' => '/images/avatars/default.png',
                'created_at' => $date
            ),
        );

        foreach ($articles as $article) {
            DB::table('posts')->insert($article);
        }

        $this->command->info('Posts table has been seeded!');
    }

}
