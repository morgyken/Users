<?php

/*
 * =============================================================================
 *
 * Collabmed Solutions Ltd
 * Project: Collabmed Health Platform
 * Author: Samuel Okoth <sodhiambo@collabmed.com>
 *
 * =============================================================================
 */

namespace Ignite\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
                //
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Format validation rules
     * @return array
     */
    public function messages() {
        return [];
    }

}
