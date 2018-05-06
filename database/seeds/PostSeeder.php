<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->truncate();

        $posts = [
            [
                'category_id' => 1,
                'author_id' => 1,
                'title' => 'Google Chrome научился блокировать автовоспроизведение видеоконтента',
                'image' => 'blog-2.jpg',
                'text' => '<p>В Google Chrome <a href="https://techcrunch.com/2018/05/03/chrome-now-mutes-annoying-autoplays-based-on-your-past-behavior/" data-wpel-link="external" target="_blank" rel="nofollow noopener noreferrer">появилась</a> функция автоматической блокировки воспроизведения видеоконтента, которая работает, основываясь на поведении пользователя. Компания уже <a href="https://sites.google.com/a/chromium.org/dev/audio-video/autoplay" data-wpel-link="external" target="_blank" rel="nofollow noopener noreferrer">внедрила</a> подобную функцию в мобильный браузер, теперь она есть и в десктопной версии.</p><h3>Как это работает?</h3><p>По словам представителей компании, большинство пользователей выключает звук или закрывает вкладку с автоматически воспроизводимым видео в течение первых шести секунд. Основываясь на этих измерениях, браузер анализирует пользовательскую активность и запоминает, на каких сайтах следует выключать мгновенный запуск. Для новых или не авторизованных пользователей Chrome будет автоматически блокировать видео на первой тысяче сайтов, исходя из «правила шести секунд».</p><p>В Google утверждают, что после анализа действий пользователя и обучения браузер сможет блокировать около половины такого контента.</p><p>Напомним, что в апреле 2018 года компания <a href="https://tproger.ru/news/google-chrome-66-release/" data-wpel-link="internal" rel="follow">представила</a> релиз Google Chrome 66, который добавил функцию ручной блокировки звука, а также повысил безопасность.',
                'views' => 124,
                'description' => 'Вы когда-нибудь хотели передавать IP-трафик через мессенджер? Хотели проверить, на что способен Telegram? Что значит «нет»? А надо! Ловите Teletun и наслаждайтесь!'
            ],

            [
                'category_id' => 2,
                'author_id' => 2,
                'title' => 'Представлен релиз движка Unity 2018.1',
                'image' => 'blog-1.jpg',
                'text' => '<p>В Google Chrome <a href="https://techcrunch.com/2018/05/03/chrome-now-mutes-annoying-autoplays-based-on-your-past-behavior/" data-wpel-link="external" target="_blank" rel="nofollow noopener noreferrer">появилась</a> функция автоматической блокировки воспроизведения видеоконтента, которая работает, основываясь на поведении пользователя. Компания уже <a href="https://sites.google.com/a/chromium.org/dev/audio-video/autoplay" data-wpel-link="external" target="_blank" rel="nofollow noopener noreferrer">внедрила</a> подобную функцию в мобильный браузер, теперь она есть и в десктопной версии.</p><h3>Как это работает?</h3><p>По словам представителей компании, большинство пользователей выключает звук или закрывает вкладку с автоматически воспроизводимым видео в течение первых шести секунд. Основываясь на этих измерениях, браузер анализирует пользовательскую активность и запоминает, на каких сайтах следует выключать мгновенный запуск. Для новых или не авторизованных пользователей Chrome будет автоматически блокировать видео на первой тысяче сайтов, исходя из «правила шести секунд».</p><p>В Google утверждают, что после анализа действий пользователя и обучения браузер сможет блокировать около половины такого контента.</p><p>Напомним, что в апреле 2018 года компания <a href="https://tproger.ru/news/google-chrome-66-release/" data-wpel-link="internal" rel="follow">представила</a> релиз Google Chrome 66, который добавил функцию ручной блокировки звука, а также повысил безопасность.',
                'views' => 412,
                'description' => 'Мы — стартап «Absolute», выиграли Microsoft Imagine Cup Central Asia. Наши математические открытия помогли нам создать улучшенную криптографическую систему обработки данных.'
            ],
        ];

        foreach ($posts as $post) {
            DB::table('posts')->insert([
                'category_id' => $post['category_id'],
                'author_id' => $post['author_id'],
                'title' => $post['title'],
                'image' => $post['image'],
                'text' => $post['text'],
                'views' => $post['views'],
                'description' => $post['description'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
