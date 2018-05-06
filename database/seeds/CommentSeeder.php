<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->truncate();

        $comments = [
            [
                'post_id' => 1,
                'author' => 'Олег из Anonymous',
                'email' => 'pokazanov14@gmail.com',
                'text' => 'Круто, теперь заживем))'
            ]
        ];

        foreach ($comments as $comment) {
            DB::table('comments')->insert([
                'post_id' => $comment['post_id'],
                'author' => $comment['author'],
                'email' => $comment['email'],
                'text' => $comment['text']
            ]);
        }
    }
}
