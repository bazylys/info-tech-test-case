<?php

namespace App\Http\Requests\Task;

use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class TaskUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
* @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
{
    return [
        'title'       => 'string',
        'description' => 'string|nullable',
        'deadline'    => 'date_format:Y-m-d\TH:i|required',
        'status'      => [new Enum(TaskStatus::class)],
    ];
}
}
