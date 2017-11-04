<?php

/**
 * Validation Exception
 *
 * @author  <a7mad.sa3d.2014@gmail.com> <Ahmed Saad>
 */

namespace App\Services;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

class APIValidationException extends Exception {

	/**
	 * Validator Instance
	 * @var Illuminate\Validation\Validator
	 */
	protected $validator;

	/**
	 * Render Response Status Code
	 * @var integer
	 */
	protected $response_code = 422;

	/**
	 * Validation Exception
	 * @param Validator $validator [description]
	 * @param string    $message   [description]
	 */
	public function __construct( Validator $validator, $response_code = 422, $message = 'Validation error' )
	{
		parent::__construct( $message );
		$this->validator = $validator;

		if( $response_code )
			$this->response_code = $response_code;
	}

	/**
	 * Render Exception Error Response
	 * @return Json Response
	 */
	public function render()
	{
		$errors = $this->validator->errors()->toArray();

		return new JsonResponse( [
        	'errors' => $errors,
        	'errors_array' => array_collapse( array_values( $errors ) ),
        	'first' => reset( $errors )[0],
        	'message' => 'Validation Errors',
        	'success' => false,
        	'error_code' => $this->response_code,

        ], $this->response_code );
	}

}