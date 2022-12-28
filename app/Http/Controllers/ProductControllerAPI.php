<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class ProductControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        /* 
        Menggunakan metode try dan catch 
        untuk mengendalikan error yang akan terjadi saat 
        eksekusi program di Postman saat pengetesan API 
        */
        try {
            // membuat variable $products untuk mengambil semua data sepatu
            $products = Product::select('*')->get();

            /*
            membuat variable $response dengan 
            tipe data Array untuk mengembalikan 
            respon khusus saat testing API
            */
            $response = [
                'success' => true,
                'message' => 'List Shoes Data',
                'data' => $products
            ];
            return response()->json($response, HttpFoundationResponse::HTTP_OK);     
        } catch (QueryException $e) {
            /* 
            membuat variable $error dengan tipe data Array 
            untuk mengembalikan respon khusus pada saat testing API 
            */
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
        /* membuat variable $validator 
        untuk memvalidasi data-data penting yang 
        perlu di input saat ingin membuat produk sepatu baru 
        */
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'nama' => 'required|string', 
            'harga' => 'required|integer',
            'stok' => 'required|integer', 
            'isReadyPublish' => 'required'
        ]);

        /* if condition berguna untuk mengetes, 
        apabila validasi gagal maka API akan mengembalikan error 
        berupa HTTP tidak dapa memproses entitas yang telah terinput 
        */
        if ($validator->fails()) {
            return response()->json(
                $validator->errors(), HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $product = Product::create($request->all());
            $response = [
                'success' => true,
                'message' => 'Create Shoes Data',
                'data' => $product
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
        /* membuat variable $products yang 
        berisikan syntax untuk mencari produk 
        berdasarkan id tertentu 
        */
        $product = Product::select('*')->find($id); // find method berfungsi untuk mencari data berdasarkan id
        return response()->json($product, 200);
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
        $product = Product::find($id);

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
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

        $update_product = $product->update($request->all());

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
        $product = Product::find($id)->delete(); // delete method berfungsi untuk menghapus 1 data produk berdasarkan id
        return response()->json([
            'success' => true,
            'message' => 'Shoes Data successfully deleted!',
            'data' => $product
        ]);
    }
}
