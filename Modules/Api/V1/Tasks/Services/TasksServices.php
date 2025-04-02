<?php
declare(strict_types=1);

/**
 * @author Volodymyr Artjukh
 * @copyright 2025 Volodymyr Artjukh (vladimir.artjukh@gmail.com)
 */

namespace Modules\Api\V1\Tasks\Services;

use Modules\Api\V1\Tasks\Models\Task;
use Modules\Api\V1\Tasks\Repositories\TasksRepository;
use \Illuminate\Database\Eloquent\Collection;

class TasksServices
{
    protected $repository;

    public function __construct(TasksRepository $repository)
    {
        $this->repository = $repository;
    }


    public function index(): Collection
    {
        return $this->repository->all(['id', 'title', 'description', 'is_completed']);
    }

    public function store(array $request): mixed
    {
        return $this->repository->store($request);
    }

    public function update(array $request, Task $task): Task
    {
        $task->update($request);
        return $task;
    }

    public function destroy(Task $task): Task
    {
        $task->delete();
        return $task;
    }

    public function toggleComplete(Task $task): Task
    {
        $task->is_completed = !$task->is_completed;
        $task->save();
        return $task;
    }
}
