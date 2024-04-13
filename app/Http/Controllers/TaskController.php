<?php

namespace App\Http\Controllers;

use App\Jobs\TaskJob;
use App\DTO\Task\CreateTaskDTO;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Request $request)
    {
        $createTaskDTO = new CreateTaskDTO($request->all());
        TaskJob::dispatch($createTaskDTO);

        return response(null, 204);
    }
}
