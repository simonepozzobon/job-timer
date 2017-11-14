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
          [
            'name' => 'Completato',
            'color' => 'green',
          ],
          [
            'name' => 'Lavorazione',
            'color' => 'yellow'
          ],
          [
            'name' => 'Problema'
            'color' => 'red'
          ],
          [
            'name' => 'Attesa'
            'color' => 'blue'
          ],
        ]);
    }
}
