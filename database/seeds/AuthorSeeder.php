<?php

use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('authors')->truncate();

        $authors = [
            [
                'name' => 'Рубель Миа',
                'about' => 'Итальянский Web-программист, писатель, автор более 25 книг об программировании',
                'image' => 'comment.jpg'
            ],

            [
                'name' => 'Анна Джордж',
                'about' => 'Веб-дизайнер со стажем 15 лет, работает в фирме Google',
                'image' => 'author.png'
            ]
        ];

        foreach ($authors as $author) {
            DB::table('authors')->insert([
                'name' => $author['name'],
                'about' => $author['about'],
                'image' => $author['image']
            ]);
        }
    }
}
