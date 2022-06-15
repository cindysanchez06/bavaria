<?php

namespace App\Http\Controllers;

use App\Models\Childrens;
use Illuminate\Http\Request;
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
            $children = new Childrens();
            $children->name = $request->name;
            $children->age = $request->age;
            $children->employees_id = $request->employees_id;
            $children->save();
            $response->setStatusCode(200);
            $response->setData($children);
        }catch (\Exception $exception)
        {
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
            if (!empty($children))
            {
                $children->employee = $children->employee();
            }
            $response->setData($children);

        } catch (\Exception $exception) {
            $response->setStatusCode(500);
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
    public function update(Request $request, Childrens $childrens)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Childrens $childrens
     * @return \Illuminate\Http\Response
     */
    public function destroy(Childrens $childrens)
    {
        //
    }
}
