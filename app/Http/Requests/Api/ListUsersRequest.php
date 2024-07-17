<?php

namespace App\Http\Requests\Api;

use App\Enums\DataProviderType;
use App\Enums\TransactionXStatus;
use App\Enums\TransactionYStatus;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListUsersRequest extends FormRequest
{
    private array $availableStatusCodes;

    public function __construct()
    {
        $this->availableStatusCodes = array_merge(TransactionXStatus::getKeys(), TransactionYStatus::getKeys());
    }

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'provider' => ['nullable', 'string', new EnumValue(DataProviderType::class)],
            'statusCode' => [
                'nullable',
                'string',
                Rule::in($this->availableStatusCodes),
            ],
            'balanceMin' => ['nullable', 'numeric'],
            'balanceMax' => ['nullable', 'numeric'],
            'currency' => ['nullable', 'string', Rule::in(['USD', 'EUR', 'AED'])],
        ];
    }
}
