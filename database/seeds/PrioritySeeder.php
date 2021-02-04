<?php

use Illuminate\Database\Seeder;
use App\Priority;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Priority::create(['title' => 'Высокий']);
        Priority::create(['title' => 'Средний']);
        Priority::create(['title' => 'Низкий']);
    }
}
