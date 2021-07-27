<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;


class DayWeekFinderController extends Controller
{
    public function dayWeekFinder(Request $request){

       /*
       * input validation
       */
        $validator = Validator::make($request->all(), [
            'fromdate' => ['required'],
            'todate' => [
                'required',
                'date',
                'after:fromdate'
            ],
            /*'fromtime' => [
                 'required',
                 'date_format:H:i:s'
            ],
            'totime' => [
                 'required',
                 'date_format:H:i:s'
            ],*/
            'timezone' => ['required','timezone '],
        ]);

        // if validation failed, then respond error 401

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], Response::HTTP_BAD_REQUEST);
        }

        try {
            if($request->input('fromdate') AND $request->input('todate') AND $request->input('timezone')){
                
                $from = Carbon::createFromFormat('Y-m-d H:i:s',$request->fromdate,$request->timezone);
                
                $to = Carbon::createFromFormat('Y-m-d H:i:s',$request->todate,$request->timezone);


                
                return response()->json([
                    'data' => [
                        'from' => $from,
                        'to' => $to,
                        'number_of_days' => $from->diffInDays($to),
                        'number_of_weeks' => $from->diffInWeeks($to)
                    ],
                    'created' => true,
                ],201);
            }

            return response()->json(['error' => 'Input field can not be empty!'],400);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
