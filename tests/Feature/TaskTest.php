<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_task()
    {
        $response = $this->postJson('/api/tasks', [
            'title' => 'Test Task',
            'description' => 'Test Description'
        ]);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(['id', 'title', 'description']);
    }

    public function test_validation_fails_without_required_fields()
    {
        $response = $this->postJson('/api/tasks', []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['title', 'description']);
    }
}
