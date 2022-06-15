<?php

namespace App\Http\Controllers;

use App\Models\Types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:45',
        ])->errors();
        if ($validator->messages()) {
            $response->setData($validator->messages());
            return $response;
        }
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
            $response->setStatusCode($exception->getCode());
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
    public function update(Request $request, Types $types, $id)
    {
        $response = new JsonResponse();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:45',
        ])->errors();
        if ($validator->messages()) {
            $response->setData($validator->messages());
            return $response;
        }
        try {
            $type = Types::find($id);
            if ($type) {
                $type->name = $request->name;
                $type->save();
                $response->setData('Type edited');
            } else {
                $response->setData('Type not found');
            }

        } catch (\Exception $exception) {
            $response->setStatusCode($exception->getCode());
            $response->setData($exception->getMessage());
        }
        return $response;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Types $types
     * @return \Illuminate\Http\Response
     */
    public function destroy(Types $types, $id)
    {
        $response = new JsonResponse();

        try {
            $type = Types::find($id);
            if ($type) {
                $type->delete();
                $response->setData('Type deleted');
            } else {
                $response->setData('Type Not found');
            }

        } catch (\Exception $exception) {
            $response->setStatusCode($exception->getCode());
            $response->setData($exception->getMessage());
        }
        return $response;
    }
}
