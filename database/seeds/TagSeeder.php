<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(['title' => 'Проектирование']);
        Tag::create(['title' => 'Разработка']);
        Tag::create(['title' => 'Дизайн']);
    }
}
