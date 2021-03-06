<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(PostSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(AuthorSeeder::class);
        $this->call(UserSeeder::class);
    }
}
