<?php

use Illuminate\Database\Seeder;

class TodoStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todo_statuses')->insert([
          ['name' => 'Completato'],
          ['name' => 'Lavorazione'],
          ['name' => 'Problema'],
          ['name' => 'Attesa'],
        ]);
    }
}
