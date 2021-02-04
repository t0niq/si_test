<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(['title' => 'Новая']);
        Status::create(['title' => 'В работе']);
        Status::create(['title' => 'Завершена']);
    }
}
