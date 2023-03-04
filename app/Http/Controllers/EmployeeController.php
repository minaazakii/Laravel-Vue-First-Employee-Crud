<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employee.index');
    }
    public function create()
    {
        $data =['test'];
        return view('employee.create');
    }
    public function store(Request $request)
    {
        try
        {
            $employee = Employee::create(
                [
                    'name'=>$request->username,
                    'section'=>$request->section,
                    'department'=>$request->department,
                    'email'=>$request->email
                ]);
                return response()->json([
                    'message'=>'Employee created'
                ],200);
        }
        catch(Exception $e)
        {
            dd($e);
        }
    }
    public function getAllEmployees()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }
    public function updateEmployee($id,Request $request)
    {
        try{
            $employee = Employee::findOrFail($id);
            $employee->update($request->all());
            return response()->json(
                [
                    'message'=>'Employee updated',
                ],200);
        }catch(Exception $e )
        {
            dd($e);
        }
    }
    public function deleteEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return response()->json(
            [
                'message'=>'Employee deleted'
            ],200);
    }
}
