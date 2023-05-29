<?php

namespace App\Http\Requests\Subreddit;

use App\Helpers\Enums\SubredditStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class SubredditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'url' => ['required', 'string', 'url', 'min:3', 'max:50'],
            'logo' => ['string'],
            'title' => ['string'],
            'status' => ['integer', Arr::pluck(SubredditStatusEnum::cases(), 'value')],

            'with_pagination' => 'boolean',
            'page' => 'integer|min:1',
            'per_page' => 'integer|max:100',
            'order_by' => 'string',
            'order_type' => 'string|in:asc,desc',
        ];
    }

    protected function prepareForValidation(): void
    {
        if (! $this->has('with_pagination')) {
            $this->merge(['with_pagination' => true]);
        }
        if (! $this->has('page')) {
            $this->merge(['page' => 1]);
        }
        if (! $this->has('per_page')) {
            $this->merge(['per_page' => 50]);
        }
        if (! $this->has('order_by')) {
            $this->merge(['order_by' => 'id']);
        }
        if (! $this->has('order_type')) {
            $this->merge(['order_by' => 'desc']);
        }
    }
}
