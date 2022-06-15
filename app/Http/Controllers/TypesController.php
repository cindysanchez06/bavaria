<?php

namespace App\Http\Controllers;

use App\Models\Types;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class TypesController extends Controller
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
            $response->setData(Types::all());
        } catch (\Exception $exception) {
            $response->setStatusCode($exception->getCode());
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

        try {
            $type = new Types;
            $type->name = $request->name;
            $type->save();
            $response->setStatusCode(200);
            $response->setData($type);
        } catch (\Exception $exception) {
            $response->setStatusCode($exception->getCode());
            $response->setData($exception->getMessage());
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Types $types
     * @return \Illuminate\Http\Response
     */
    public function show(Types $types, int $id)
    {
        $response = new JsonResponse();
        try {
            $type = Types::find($id);
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
     * @param \App\Models\Types $types
     * @return \Illuminate\Http\Response
     */
    public function edit(Types $types)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Types $types
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Types $types)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Types $types
     * @return \Illuminate\Http\Response
     */
    public function destroy(Types $types)
    {
        //
    }
}
