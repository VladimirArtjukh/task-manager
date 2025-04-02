<?php
declare(strict_types=1);

/**
 * @author Volodymyr Artjukh
 * @copyright 2025 Volodymyr Artjukh (vladimir.artjukh@gmail.com)
 */

namespace Modules\Api\V1\Tasks\Repositories;

use Modules\Api\V1\Tasks\Models\Task;
use \Illuminate\Database\Eloquent\Collection;

class TasksRepository
{
    protected Task $model;

    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->model->all($columns);
    }

    public function store(array $data): mixed
    {
        return $this->model->create($data);
    }

}
