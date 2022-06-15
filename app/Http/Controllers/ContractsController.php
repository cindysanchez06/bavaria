<?php

namespace App\Http\Controllers;

use App\Models\Contracts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;

class ContractsController extends Controller
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
            $response->setData(Contracts::all());
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = new JsonResponse();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:45',
            'date' => 'required|date',
            'file' => 'required|max:45',
            'employees_id' => 'required|max:99999',
        ])->errors();

        if ($validator->messages()) {
            $response->setData($validator->messages());
            return $response;
        }
        try {
            $contract = new Contracts();
            $contract->name = $request->name;
            $contract->date = $request->date;
            $contract->file = $request->file;
            $contract->employees_id = $request->employees_id;
            $contract->save();
            $response->setStatusCode(200);
            $response->setData($contract);
        } catch (\Exception $exception) {
            $response->setStatusCode($exception->getCode());
            $response->setData($exception->getMessage());
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Contracts $contracts
     * @return \Illuminate\Http\Response
     */
    public function show(Contracts $contracts, int $id)
    {
        $response = new JsonResponse();
        try {
            $contracts = Contracts::find($id);
            if (!empty($contracts)) {
                $contracts->employees = $contracts->employee();
            }
            $response->setData($contracts);

        } catch (\Exception $exception) {
            $response->setStatusCode(500);
            $response->setData($exception->getMessage());
        }
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Contracts $contracts
     * @return \Illuminate\Http\Response
     */
    public function edit(Contracts $contracts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Contracts $contracts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contracts $contracts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Contracts $contracts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contracts $contracts)
    {
        //
    }
}
