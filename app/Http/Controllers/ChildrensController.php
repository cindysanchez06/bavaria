<?php

namespace App\Http\Controllers;

use App\Models\Childrens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;

class ChildrensController extends Controller
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
            $response->setData(Childrens::all());
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
            'age' => 'required|integer|max:200',
            'employees_id' => 'required|max:99999',
        ])->errors();

        if ($validator->messages()) {
            $response->setData($validator->messages());
            return $response;
        }
        try {
            $children = new Childrens();
            $children->name = $request->name;
            $children->age = $request->age;
            $children->employees_id = $request->employees_id;
            $children->save();
            $response->setStatusCode(200);
            $response->setData($children);
        } catch (\Exception $exception) {
            $response->setStatusCode($exception->getCode());
            $response->setData($exception->getMessage());
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Childrens $childrens
     * @return \Illuminate\Http\Response
     */
    public function show(Childrens $childrens, int $id)
    {
        $response = new JsonResponse();
        try {
            $children = Childrens::find($id);
            if (!empty($children)) {
                $children->employee = $children->employee();
            }
            $response->setData($children);

        } catch (\Exception $exception) {
            $response->setStatusCode($exception->getCode());
            $response->setData($exception->getMessage());
        }
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Childrens $childrens
     * @return \Illuminate\Http\Response
     */
    public function edit(Childrens $childrens)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Childrens $childrens
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Childrens $childrens, $id)
    {
        $response = new JsonResponse();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:45',
            'age' => 'required|integer|max:200',
            'employees_id' => 'required|max:99999',
        ])->errors();

        if ($validator->messages()) {
            $response->setData($validator->messages());
            return $response;
        }
        try {
            $children = Childrens::find($id);
            if ($children)
            {
                $children->name = $request->name;
                $children->age = $request->age;
                $children->employees_id = $request->employees_id;
                $children->save();
                $response->setStatusCode(200);
                $response->setData('Children edited');
            }
            else{
                $response->setData('Children not found');
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
     * @param \App\Models\Childrens $childrens
     * @return \Illuminate\Http\Response
     */
    public function destroy(Childrens $childrens, $id)
    {
        $response = new JsonResponse();
        try {
            $children = Childrens::find($id);
            if ($children) {
                $children->delete();
                $response->setData('Children deleted');
            }else{
                $response->setData('Children Not found');
            }

        } catch (\Exception $exception) {
            $response->setStatusCode($exception->getCode());
            $response->setData($exception->getMessage());
        }
        return $response;
    }
}
