<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StudentRequest;
use Illuminate\Http\Request;

class StudentController extends Controller
{

	/**
	 * calculate Student Sessions
	 * @param  StudentRequest $request [description]
	 * @return [type]                  [description]
	 */
    public function getSessions( StudentRequest $request )
    {
    	$chapters_count = 30;

    	// Chapters Sessions
    	$sessions = collect( range( 1, $chapters_count ) )->transform( function( $chapter ) use( $request ) {

    		// Chapter sessions
    		$sessions = collect();

    		for( $i = 1; $i<= $request->input('chapter_days'); $i++ ){

    			while( !in_array( $request->_start_date->dayOfWeek, $request->input('days') ) ){
    				$request->_start_date->addDay();
    			}

    			$sessions->push( $request->_start_date->format( 'D d-m-Y' ) );
				$request->_start_date->addDay();
    		}

    		$chapter_sessions = [
    			'chapter' => $chapter,
    			'sessions' => $sessions
    		];

    		return $chapter_sessions;
    	} );


    	// Send response
    	return $this->sendResponse( [
    		'number_of_chapters' => $chapters_count,
    		'sessions_per_chapter' => $request->input('chapter_days'),
    		'sessions_per_week' => count( $request->input('days') ),
    		'first_session_date' => $request->_first_date->format( 'D d-m-Y' ),
    		'last_session_date' => $request->_start_date->subDay()->format( 'D d-m-Y' ),
    		'sessions' => $sessions
    	] );
    }
}
