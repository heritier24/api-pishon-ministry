<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|string|max:255',
            'status' => 'required|in:pending,paid,unpaid',
            'reason' => 'nullable|string|max:255',
        ];
    }
}
