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
                'author' => 'Justify',
                'email' => 'justifydev@gmail.com',
                'text' => 'Круто, теперь заживем))'
            ],
            [
                'post_id' => 1,
                'author' => 'Justify',
                'email' => 'justifydev@gmail.com',
                'text' => 'Ура!'
            ],
            [
                'post_id' => 1,
                'author' => 'Justify',
                'email' => 'justifydev@gmail.com',
                'text' => 'Наконец-то'
            ],
            [
                'post_id' => 1,
                'author' => 'Justify',
                'email' => 'justifydev@gmail.com',
                'text' => 'Круто ;)'
            ],
            [
                'post_id' => 1,
                'author' => 'Justify',
                'email' => 'justifydev@gmail.com',
                'text' => 'О да'
            ],
            [
                'post_id' => 1,
                'author' => 'Justify',
                'email' => 'justifydev@gmail.com',
                'text' => 'Теперь заживем))'
            ],
            [
                'post_id' => 3,
                'author' => 'Justify',
                'email' => 'justifydev@gmail.com',
                'text' => 'Всем привет))'
            ],
            [
                'post_id' => 4,
                'author' => 'Justify',
                'email' => 'justifydev@gmail.com',
                'text' => 'Приветы'
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
