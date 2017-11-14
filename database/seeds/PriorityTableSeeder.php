<?php

use Illuminate\Database\Seeder;

class PriorityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('priorities')->insert([
          [
            'title' => 'Normale'
          ],
          [
            'title' => 'Media'
          ],
          [
            'title' => 'Alta'
          ],
        ]);
    }
}
