<?php
/**
 * API Response Trait
 * @package ApiResponseTrait
 * @author Ahmed Saad <ahmed.saad@code95.com>
 */

namespace App\Services;

use Illuminate\Support\Facades\Response;

trait APIResponseTrait
{
	/**
	 * Send Success Response
	 */
	public function sendResponse( $response_data, $message = 'Successfully Retrieved', array $extra_data = null)
	{
		$message = ($message == null)? 'Successfully Retrieved': $message;

		$defualt = [
			'success' => true,
			'data' => $response_data,
			'message' => $message
		];
		$result = ($extra_data) ? array_merge($defualt, $extra_data) : $defualt;
		return Response::json($result);
	}

	/**
	 * Send Success Paginated Response
	 */
	public function sendPaginatedResponse( \Illuminate\Pagination\LengthAwarePaginator $response_paginated_data, $message = 'Successfully Retrieved' )
	{
		// $all =  $response_paginated_data->toArray();

		// $meta = $response_paginated_data->getCollection()->except('data');
		// $data = $all['data'];
		// unset( $all['data'] );
		$data = array_merge( $response_paginated_data->toArray(),[
			'message' => $message,
			'success' => true,
		] );

		// $data = [
		// 	'data' => $data,
		// 	'meta' => $all,
		// 	'message' => $message,
		// 	'success' => true,
		// ];
		return $data;
	}

	/**
	 * Send Success Response by transformer
	 */
	public function ResponseTrans( $response_data, $message = 'Successfully Retrieved' )
	{
		return Response::json(
			array_merge($response_data,[
			'success' => true,
			'message' => $message
			]));
	}

	/**
	 * Send error Response
	 */
	public function sendError( $message = 'Error', $status_code = 200 )
	{
		return Response::json([
			'success' => false,
			'message' => $message
			], $status_code );
	}
}