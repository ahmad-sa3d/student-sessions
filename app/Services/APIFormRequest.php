<?php

/**
 * Custom Form request For APIS
 *
 * @author   <ahmed.saad@code95.com> <By Ahmed Saad>
 *
 *
 * @property-read Integer $status_code Response status code
 */


namespace App\Services;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use App\Services\APIValidationException;

class APIFormRequest extends FormRequest
{
	protected static $status_code = 422;

	/**
	 * Set Custom Response Error Code
	 * @param integer $value [description]
	 */
	public static function setStatusCode( $value = 422 )
	{
		self::$status_code = $value;
	}

	/**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
    	throw new APIValidationException( $validator, $this->responseCode(), 'Validation Error' );
    }

	/**
	 * Get Response Status Code
	 * @return [type] [description]
	 */
	public function responseCode()
	{
		return self::$status_code;
	}
	
}