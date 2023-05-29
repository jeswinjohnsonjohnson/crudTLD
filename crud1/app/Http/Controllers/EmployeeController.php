<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Employees;




class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employees::all();
        return response()->json($employees);
    }  

    
    
    public function store(Request $request)
    {
        $employees = new Employees([
            'Employee_Name' => $request->input('Employee_Name'),
            'Address' => $request->input('Address'),
            'Email' => $request->input('Email'),
            'Date'=> $request->input('Date'),
            'Status'=> $request->input('Status'),
            'Phone'=> $request->input('Phone'),
            'selectedGender'=> $request->input('selectedGender'),
        ]);

        $employees->save();
        return response()->json('Employee created!');
    }

    
    public function show($id)
    {
        $employees = Employees::find($id);
        return response()->json($employees);
    }


    public function update(Request $request, $id) 
    {
       $employees = Employees::find($id);
       $employees->update($request->all());
       return response()->json('Employee updated');
    }


    public function destroy($id)
    {
        $employees = Employees::find($id);
        $employees->delete();
        return response()->json(' deleted!');
    }


    
  
 }

