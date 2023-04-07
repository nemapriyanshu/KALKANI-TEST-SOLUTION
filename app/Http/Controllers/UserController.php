<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "index";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "HEY";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            User::create([
                "firstname" => $request->firstname,
                "lastname" => $request->lastname,
                "mobilenumber" => $request->mobilenumber,
                "email" => $request->email,
                "address1" => $request->address1,
                "city" => $request->city,
                "state" => $request->state,
                "type" => $request->type,
                "pincode" => $request->pincode,
                "password" => $request->password,
                //optional fields 
                "address2" => $request->address2 ?? "",
                "dateofbirth" => $request->dateofbirth ?? null,
            ]);
            return response()->json([
                'message' => 'Data Entered Successfully !',
            ]);
        } catch (\Exception$e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function SearchUser(Request $request){
        $filters =  explode(',',$request->search);
        // $allData =User::where('firstname', 'like', '%' . $request->search . '%')->get();
        $allData = DB::table('users')
        ->where(function($query) use ($filters) {
            foreach($filters as $value) {
                $query->orWhere('firstname', 'like', '%' . $value . '%');
                $query->orWhere('lastname', 'like', '%' . $value . '%');
                $query->orWhere('email', 'like', '%' . $value . '%');
                $query->orWhere('city', 'like', '%' . $value . '%');
                $query->orWhere('age', 'like', '%' . $value . '%');
            }
        })
        ->get();
        return response()->json([
            "data" => $allData
        ]);
    }
}