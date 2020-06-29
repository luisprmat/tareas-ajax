<?php

use App\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Task::class)->create([
            'title' => 'Aprender Vue.js'
        ]);

        factory(Task::class)->create([
            'title' => 'Suscribirse en Styde'
        ]);

        factory(Task::class)->create([
            'title' => 'Grabar lección de Vue',
            'status' => 'completed'
        ]);

        factory(Task::class)->create([
            'title' => 'Aprender Sass!!'
        ]);
    }
}
