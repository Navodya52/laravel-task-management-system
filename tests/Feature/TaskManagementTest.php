<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_task_dashboard(): void
    {
        $response = $this->get('/tasks');

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_open_task_dashboard(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/tasks');

        $response->assertOk();
    }

    public function test_user_can_create_a_task(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/tasks', [
            'title' => 'Automated Test Task',
            'description' => 'Testing task creation',
            'priority' => 'medium',
            'due_date' => null,
        ]);

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', [
            'user_id' => $user->id,
            'title' => 'Automated Test Task',
            'status' => 'pending',
        ]);
    }

    public function test_user_only_sees_their_own_tasks(): void
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        Task::create([
            'user_id' => $userA->id,
            'title' => 'Private Task A',
            'status' => 'pending',
            'priority' => 'medium',
        ]);

        Task::create([
            'user_id' => $userB->id,
            'title' => 'Private Task B',
            'status' => 'pending',
            'priority' => 'medium',
        ]);

        $response = $this->actingAs($userA)->get('/tasks');

        $response->assertOk();
        $response->assertSee('Private Task A');
        $response->assertDontSee('Private Task B');
    }
}
