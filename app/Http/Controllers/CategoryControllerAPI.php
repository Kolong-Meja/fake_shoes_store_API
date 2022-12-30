<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;


class CategoryControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::select('*')->with('products')->get();
        $response = [
            'success' => true,
            'message' => 'Category Data',
            'data' => $categories
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            'slug' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(), HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $category = Category::create($request->all());
            $response = [
                'success' => true,
                'message' => 'Category data has been successfully created',
                'data' => $category
            ];
            return response()->json($response, HttpFoundationResponse::HTTP_CREATED);
        } catch (QueryException $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::select('*')->with('products')->find($id);
        $response = [
            'success' => true,
            'message' => "Category {$id} Data",
            'data' => $category
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(), HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $update_category = $category->update($request->all());

        if ($update_category) {
            $response = [
                'success' => true,
                'message' => "Category {$id} data has been successfully updated",
                'data' => $category
            ];
            return response()->json($response, HttpFoundationResponse::HTTP_OK);
        }

        else {
            $response = [
                'success' => false,
                'message' => "Category {$id} data failed to updated",
                'data' => null
            ];
            return response()->json($response, HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id)->delete();
        $response = [
            'success' => true,
            'message' => "Category {$id} data has been successfully deleted",
            'data' => $category
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }
}
