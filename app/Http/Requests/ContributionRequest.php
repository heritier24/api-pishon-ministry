<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ContributionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'member_id' => 'required|exists:members,id',
            'date' => 'nullable|date',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|string|max:255',
            'status' => 'required|in:pending,paid,unpaid',
            'reason' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'The email has already been taken.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new ValidationException($validator, $this->buildFailedValidationResponse($validator));
    }

    /**
     * Build the response for failed validation.
     */
    protected function buildFailedValidationResponse(\Illuminate\Contracts\Validation\Validator $validator): JsonResponse
    {
        return new JsonResponse([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422);
    }
}
