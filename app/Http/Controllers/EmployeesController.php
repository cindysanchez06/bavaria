<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = new JsonResponse();
        try {
            $response->setData(Employees::all());
        } catch (\Exception $exception) {
            $response->setStatusCode(500);
            $response->setData($exception->getMessage());
        }
        return $response;
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
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $response = new JsonResponse();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:45',
            'phone' => 'required|integer|max:99999',
            'address' => 'required|max:45',
            'types_id' => 'required|max:99999',
        ])->errors();

        if ($validator->messages()) {
            $response->setData($validator->messages());
            return $response;
        }

        try {
            $employee = new Employees;
            $employee->name = $request->name;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->types_id = $request->types_id;
            $employee->save();
            $response->setStatusCode(200);
            $response->setData($employee);
        } catch (\Exception $exception) {
            $response->setStatusCode($exception->getCode());
            $response->setData($exception->getMessage());
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Employees $employees
     * @return \Illuminate\Http\Response
     */
    public function show(Employees $employees, int $id)
    {
        $response = new JsonResponse();
        try {
            $type = Employees::find($id);
            if (!empty($type)) {
                $type->type = $type->type();
                $type->childrens = $type->childrens();
                $type->contracts = $type->contracts();
            }
            $response->setData($type);

        } catch (\Exception $exception) {
            $response->setStatusCode(500);
            $response->setData($exception->getMessage());
        }
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Employees $employees
     * @return \Illuminate\Http\Response
     */
    public function edit(Employees $employees)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Employees $employees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employees $employees)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Employees $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employees $employees)
    {
        //
    }
}
