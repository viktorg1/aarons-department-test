<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         *
         * Using laravel ingregated pagination for User Collection.
         *
         * Pagination helps lower memory usage for faster loading time.
         * Pagination also helps with User Experience(UX) and User Interface(UI).
         *
         */
        $users = User::paginate(10);

        return view('employees.index', compact('users'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        // Checking if the user exists
        if ($user != null){
            // If the user does exist, the following happens.

            // Getting the last five payments for the $id of the User
            $last_five = Shift::where('user_id', $user->id)
                              ->orderByDesc('date')
                              ->limit(5)
                              ->get();
            // Getting the average total pay of the user
            $avg_totalpay = $user->shifts()
                                 ->select(DB::raw('avg(avg_hour * hours) as avg'))
                                 ->where('user_id', strval($user->id))
                                 ->first();
            // Getting the average per hour pay of the user
            $avg_perhour = $user->shifts()
                                ->where('user_id', $user->id)
                                ->avg('avg_hour');
            return view('employees.show', compact('user', 'last_five', 'avg_totalpay', 'avg_perhour'));
        }
        // If the user doesn't exist, he gets redirected back to employee page
        return redirect()->route('employees.index');
    }

}
