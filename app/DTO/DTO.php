<?php

namespace App\DTO;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

abstract class DTO extends Collection
{
    public function __construct($items = [])
    {
        parent::__construct($items);
        $this->validate();
    }

    private function validate()
    {
        $transformedData = $this->transformData();

        foreach ($transformedData as $key => $value) {
            $this->put($key, $value);
        }

        $validator = Validator::make($this->all(), $this->rules());
        $validator->validate();
    }

    protected function rules(): array
    {
        return [];
    }

    protected function transformData(): array
    {
        return [];
    }
}
