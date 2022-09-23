<?php

namespace App\Http\Controllers;

use App\Imports\ShiftsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employees.import');
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

        // Collecting all of the requested data into a variable called $data
        $data = $request->all();

        // Array with validation rules
        $rules = [
            'shifts' => 'required|mimes:csv',
        ];

        // Validate the data with the rules through an integrated Laravel function
        $validator = Validator::make($data, $rules);


        // In case the validator fails, return a response with status 400 and error message
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        // If the import was successfull return back a response with status 200 and a message to be used with a notification
        if(Excel::import(new ShiftsImport, $request->file('shifts')->store('temp'))){
            return response()->json('File successfully imported.', 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
