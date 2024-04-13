<?php

namespace App\DTO\Task;

use App\DTO\DTO;
use Illuminate\Support\Str;

class CreateTaskDTO extends DTO
{
    protected function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'url' => ['required', 'url'],
            'method' => ['required', 'in:POST,GET,HEAD,PUT,DELETE,PATCH'],
            'headers' => ['nullable', 'array'],
            'query' => ['nullable', 'array'],
            'body' => ['nullable', 'array'],
            'schedule_time' => ['nullable', 'date'],
            'max_tries' => ['nullable', 'integer'],
            'timeout' => ['nullable', 'integer']
        ];
    }

    protected function transformData(): array
    {
        return [
            'method' => Str::upper($this->get('method'))
        ];
    }
}
