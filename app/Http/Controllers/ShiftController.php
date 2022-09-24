<?php

namespace App\Http\Controllers;

use App\Models\Shift as Shift;
use App\Models\User;
use App\Models\Employer;
use Illuminate\Http\Request;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                    'date' => 'required',
                    'user_id' => 'required',
                    'employer_id' => 'required',
                    'hours' => 'required',
                    'avg_hour' =>'required',
                    'taxable' => 'required',
                    'status' => 'required',
                    'shift_type' => 'required',
                    'paid_at' => 'required',
                ];

                $validator  = Validator::make($data, $rules);
                if($validator->fails()){
                    return response()->json(['message' => $validator->errors()->first()], 404);
                }

                Shift::create([
                    'date' => $data['date'],
                    'user_id' => $data['user_id'],
                    'employer_id' => $data['employer_id'],
                    'hours' => $data['hours'],
                    'avg_hour' => $data['avg_hour'],
                    'taxable' => $data['taxable'],
                    'status' => $data['status'],
                    'shift_type' => $data['shift_type'],
                    'paid_at' => $data['paid_at'],
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'date' => 'required',
            'user_id' => 'required',
            'employer_id' => 'required',
            'hours' => 'required',
            'avg_hour' =>'required',
            'taxable' => 'required',
            'status' => 'required',
            'shift_type' => 'required',
        ];

        $validator  = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json(['message' => $validator->errors()->first()], 404);
        }

        $shift = Shift::find($id);
        if ($shift != null) {
            // Shift updating.
            $shift->user_id = $data['user_id'];
            $shift->employer_id = $data['employer_id'];
            $shift->hours = $data['hours'];
            $shift->avg_hour = $data['avg_hour'];
            $shift->taxable = $data['taxable'];
            $shift->status = $data['status'];
            $shift->shift_type = $data['shift_type'];
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
