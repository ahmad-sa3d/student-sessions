<?php

namespace App\Http\Requests\API;

use App\Services\APIFormRequest;
use Carbon\Carbon;


class StudentRequest extends APIFormRequest
{
    /**
     * Start Date
     * @var Carbon
     */
    public $_start_date;

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
            'start_date' => 'required|date_format:d-m-Y|future_day',
            'days' => 'required|array|max:7|min:1',
            'days.*' => 'integer|min:0|max:6',
            'chapter_days' => 'required|integer|min:1',
        ];
    }

    /**
     * Validation Messages
     * @return [type] [description]
     */
    public function messages()
    {
        return [
            'days.array' => 'sessions per week must be array of week days numbers',
            'days.min' => 'sessions per week is required',
            'days.max' => 'sessions per week is required and cannot be greater than 7 sessions per week',
            'days.*' => 'sessions days must be valid day numbers between 0 and 6',
            'chapter_days.*' => 'number of sessions required to finish one chapter is required',
        ];
    }

    /**
     * Prepare Values for validation
     * @return [type] [description]
     */
    public function prepareForValidation()
    {
        $days = [];
        foreach( array_sort( $this->input( 'days' ) ) as $day ){
            if( $day == 0 )
                $day = 6;
            else
                $day--;

            $days[] = $day;
        }

        $this->merge( [
            'days' => $days,
        ] );
    }

    /**
     * Extra Validation
     * @param  [type] $validator [description]
     * @return [type]            [description]
     */
    public function withValidator( $validator )
    {
        try{
            $this->_start_date = Carbon::createFromFormat( 'd-m-Y', $this->input( 'start_date' ) );
            $this->_first_date = clone $this->_start_date;

            while( !in_array( $this->_first_date->dayOfWeek, $this->input('days') ) ){
                $this->_first_date->addDay();
            }
        } catch( \Exception $e ){
            
        }

    }
}
