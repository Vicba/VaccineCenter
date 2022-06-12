<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Booking;
use App\Models\Vaccine;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\Confirmation;


class VaccineController extends Controller
{
    function test(){
        return ["message" => "test"];
    }


    function vaccines(){
        $vaccines = Vaccine::all();
        return ["data" => $vaccines];
    }

    function booking(Request $request){

        $rules = [
                "name" => "string|min:1|max:50|required",
                "vaccine_id" => "numeric|required",
                "date" => "after_or_equal:today|date|required",
                "allergies" => "string|min:1|max:255|nullable"
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(["errors" => $validator->errors()],
               Response::HTTP_UNPROCESSABLE_ENTITY);
        }else{
            $data = $validator -> validated();

            $booking = new Booking();

            $booking -> name = $request -> input("name");
            $booking -> vaccine_id = $request -> input("vaccine_id");
            $booking -> date = $request -> input("date");
            $booking -> allergies = $request -> input("allergies");

            $booking -> save();

            $msg = new Confirmation($booking);
            Mail::to("victor.barra@student.howest.be") -> send($msg);

            return $booking;
        }
    }
}
