<?php

namespace Tests\Feature\Tasks;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function get_tasks_as_json()
    {
        $this->withoutExceptionHandling();

        $task = factory(Task::class)->create([
            'title' => 'Title of task',
        ]);

        $this->get('api/tasks')
            ->assertOk()
            ->assertJsonFragment([
                'id' => $task->id,
                'title' => 'Title of task',
                'status' => 'pending'
            ]);
    }
}
