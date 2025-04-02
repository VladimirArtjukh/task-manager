<?php
declare(strict_types=1);

/**
 * @author Volodymyr Artjukh
 * @copyright 2025 Volodymyr Artjukh (vladimir.artjukh@gmail.com)
 */

namespace Modules\Api\V1\Tasks\Controllers;

use App\Http\Controllers\Controller;
use Modules\Api\V1\Tasks\Models\Task;
use Modules\Api\V1\Tasks\Requests\TaskRequest;
use Modules\Api\V1\Tasks\Resources\TaskResource;
use Modules\Api\V1\Tasks\Services\TasksServices;
use Symfony\Component\HttpFoundation\Response;
use \Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    protected TasksServices $tasksServices;

    public function __construct(TasksServices $tasksServices)
    {
        $this->tasksServices = $tasksServices;
    }

    public function index(): TaskResource
    {
        return new TaskResource($this->tasksServices->index());
    }

    public function store(TaskRequest $request): TaskResource
    {
        return new TaskResource($this->tasksServices->store($request->toArray()));
    }

    public function update(TaskRequest $request, Task $task): TaskResource
    {
        return new TaskResource($this->tasksServices->update($request->toArray(), $task));
    }

    public function destroy(Task $task): JsonResponse
    {
        $task->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function toggleComplete(Task $task): TaskResource
    {
        return new TaskResource($this->tasksServices->toggleComplete($task));
    }
}
