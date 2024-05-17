<?php

declare(strict_types=1);

namespace App\Modules\PetStore\Requests;

use App\Modules\PetApiConnector\Enums\PetStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PetStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['gt:0'],
            'name' => ['required', 'min:1', 'max:255'],
            'category' => ['array:id,name'],
            'photoUrls' => ['required', 'array'],
            'photoUrls.*' => ['required', 'min:1'],
            'tags' => ['array'],
            'tags.*.id' => ['gt:0'],
            'tags.*.name' => ['min:1', 'max:255'],
            'status' => [Rule::enum(PetStatusEnum::class)],
        ];
    }
}
