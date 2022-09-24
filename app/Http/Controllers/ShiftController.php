<?php

namespace App\Http\Controllers;

use App\Models\Shift as Shift;
use App\Models\User;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Using laravel ingregated pagination for User Collection.
         *
         * Pagination helps lower memory usage for faster loading time.
         * Pagination also helps with User Experience(UX) and User Interface(UI).
         */
        $shifts = Shift::paginate(10);

        // Getting the users and employers for Create dropdown modal
        $users = User::all();
        $employers = Employer::all();

        return view('employees.totalpay', compact('shifts', 'users', 'employers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                // Get the request in a variable $data
                $data = $request->all();

                // Validation Rules
                $rules = [
                    'date'          => 'required',
                    'user_id'       => 'required',
                    'employer_id'   => 'required',
                    'hours'         => 'required',
                    'avg_hour'      =>'required',
                    'taxable'       => 'required',
                    'status'        => 'required',
                    'shift_type'    => 'required',
                ];
                // Using validator to validate the data with the given rules
                $validator  = Validator::make($data, $rules);

                // In case validator fails, it responds with the error
                if($validator->fails()){
                    return response()->json(['message' => $validator->errors()->first()], 404);
                }

                // Creating the Shift with the given parameters through the Request
                Shift::create([
                    'date'          => $data['date'],
                    'user_id'       => $data['user_id'],
                    'employer_id'   => $data['employer_id'],
                    'hours'         => $data['hours'],
                    'avg_hour'      => $data['avg_hour'],
                    'taxable'       => $data['taxable'],
                    'status'        => $data['status'],
                    'total_pay'     => $data['total_pay'],
                    'shift_type'    => $data['shift_type'],
                    'paid_at'       => $data['paid_at'],
                ]);
                return response()->json(['message' => "Shift created."], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shift = Shift::find($id);

        // Checking if the shift exists
        if ($shift != null){
                // Return a response

                return response()->json(['message' => $shift], 200);
        }
        // If the shift doesn't exist, returns an error message
        return response()->json(['message' => "There was an error."], 400);
    }

        /**
     * Display the filtered resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filter($filter)
    {
        /**
         *
         * Filter function should be working with AJAX/API callback.
         *
         *
         */
        $shifts = Shift::where('total_pay', '>', intval($filter))->paginate(10);
        // Getting the users and employers for Create dropdown modal
        $users = User::all();
        $employers = Employer::all();

        return view('filter.index', compact('shifts', 'users', 'employers'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Get the request in a variable $data
        $data = $request->all();

        // Validation Rules
        $rules = [
            'date'          => 'required',
            'user_id'       => 'required',
            'employer_id'   => 'required',
            'hours'         => 'required',
            'avg_hour'      =>'required',
            'taxable'       => 'required',
            'status'        => 'required',
            'shift_type'    => 'required',
        ];

        // Using validator to validate the data with the given rules
        $validator  = Validator::make($data, $rules);

        // In case validator fails, it responds with the error
        if($validator->fails()){
            return response()->json(['message' => $validator->errors()->first()], 404);
        }
        // Get the Shift with the given $id from the request
        $shift = Shift::find($id);

        // Checking if the Shift does exist
        if ($shift != null) {
            // Shift updating.
            $shift->user_id         = $data['user_id'];
            $shift->employer_id     = $data['employer_id'];
            $shift->hours           = $data['hours'];
            $shift->avg_hour        = $data['avg_hour'];
            $shift->taxable         = $data['taxable'];
            $shift->status          = $data['status'];
            $shift->total_pay       = $data['total_pay'];
            $shift->shift_type      = $data['shift_type'];
            $shift->save();
            return response()->json(['message' => "Shift updated."], 200);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            // Get the shift by the given $id from the Request.

            $shift = Shift::find($id);

            // Checking if the shift exists
            if ($shift != null) {

                // Delete shift and return a response.
                $shift->delete();

                return response()->json(['message' => "Shift removed."], 200);
            }
            // If shift doesn't exist, return this message.
            return response()->json(['message' => "Shift couldn't be removed, try again."], 404);
    }
}
