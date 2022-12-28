<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Facade\FlareClient\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class ProductControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $products = Product::select('*')->get();
            $response = [
                'success' => true,
                'message' => 'List Shoes Data',
                'data' => $products
            ];
            return response()->json($response, HttpFoundationResponse::HTTP_OK);     
        } catch (QueryException $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $except_data = ['id', 'created_at', 'updated_at'];

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|max:1|min:1',
            'nama' => 'required|string', 
            'harga' => 'required|integer',
            'stok' => 'required|integer', 
            'isReadyPublish' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(), HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $products = Product::create($request->all());
            $response = [
                'success' => true,
                'message' => 'Create Shoes Data',
                'data' => $products,
            ];
            return response()->json($response, HttpFoundationResponse::HTTP_CREATED);
        } catch (QueryException $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_INTERNAL_SERVER_ERROR);
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
        $products = Product::select('*')->find($id);
        return response()->json($products, 200);
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
        $except_data = ['id', 'created_at', 'updated_at'];
        $product = Product::find($id);

        $validator = Validator::make($request->except($except_data), [
            'user_id' => 'required|integer|max:1|min:1',
            'nama' => 'required|string', 
            'harga' => 'required|integer',
            'stok' => 'required|integer', 
            'isReadyPublish' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(), HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $update_product = $product->update($request->except($except_data));

        if ($update_product) {
            return response()->json([
                'success' => true,
                'message' => 'Update Shoes Data',
                'data' => $product
            ]);
        }

        else {
            return response()->json([
                'success' => false,
                'message' => "Failed! {$e->errorInfo}",
                'data' => null
            ]);
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
        $product = Product::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Shoes Data successfully deleted!',
            'data' => $product
        ]);
    }
}
