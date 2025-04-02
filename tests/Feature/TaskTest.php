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
        $response = $this->postJson('/api/v1/tasks', [
            'title' => 'Test Task',
            'description' => 'Test Description'
        ]);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(['data' => ['id', 'title', 'description']]);
    }

    public function test_validation_fails_without_required_fields()
    {
        $response = $this->postJson('/api/v1/tasks', []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors([
                "title" => [
                    "The title field is required."
                ],
                "description" => [
                    "The description field is required."
                ]
            ]);
    }
}
