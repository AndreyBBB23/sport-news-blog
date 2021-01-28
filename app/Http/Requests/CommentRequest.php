<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'post_id' => 'required|integer',
            'name' => 'required|min:3|max:64',
            'email' => 'required|email|min:3|max:64',
            'website' => 'nullable|min:3|max:64',
            'comment' => 'required|min:32',
        ];
    }
}
