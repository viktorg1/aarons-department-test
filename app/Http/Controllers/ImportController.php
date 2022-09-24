<?php

namespace App\Http\Controllers;

use App\Imports\ShiftsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        ini_set('memory_limit', '4096M');
        ini_set('max_execution_time', 600);
        ini_set('upload_max_filesize', '5M');
        ini_set('post_max_size', '15M');
        // Collecting all of the requested data into a variable called $data
        $data = $request->all();

        // Array with validation rules
        $rules = [
            'shifts' => 'required|mimes:csv|max:5120',
        ];

        // Validate the data with the rules through an integrated Laravel function
        $validator = Validator::make($data, $rules);


        // In case the validator fails, return a response with status 400 and error message
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        // If the import was successfull return back a response with status 200 and a message to be used with a notification
        if(Excel::import(new ShiftsImport, $request->file('shifts')->store('temp'))){
            DB::update('UPDATE shifts SET avg_hour = TRIM("£" FROM avg_hour)');
            return response()->json('File successfully imported.', 200);
        }

    }

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 1000;
    }

}
