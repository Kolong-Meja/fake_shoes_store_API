<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class OrderControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::select('*')->with('users')->with('products')->get();
        $response = [
            'success' => true,
            'message' => 'Orders Data',
            'data' => $orders
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
            'user_id' => 'required|integer|min:3',
            'product_id' => 'required|integer|min:1',
            'price' => 'required|numeric|between:0.00,999999.00',
            'quantity' => 'required|numeric|between:0,100',
            'sub_total' => 'required|numeric|between:0.00,9999999.00',
            'shipping' => 'required|numeric|between:0.00,999999.00',
            'total' => 'required|numeric|between:0.00,9999999.00',
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|string|max:255',
            'user_mobile' => 'required|numeric|min:13',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'country' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(), HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $order = Order::create($request->all());
            $response = [
                'success' => true,
                'message' => 'Order data has been successfully created!',
                'data' => $order
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
        $order = Order::select('*')->with('users')->with('products')->find($id);
        $response = [
            'success' => true,
            'message' => "Order {$id} data",
            'data' => $order
        ];
        return response()->json($order, HttpFoundationResponse::HTTP_OK);
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
        $order = Order::find($id);

        $validator = Validator::make($request->all(), [
            'user_id' => 'nullable|integer|min:3',
            'product_id' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|between:0.00,999999.00',
            'quantity' => 'nullable|numeric|between:0,100',
            'sub_total' => 'nullable|numeric|between:0.00,9999999.00',
            'shipping' => 'nullable|numeric|between:0.00,999999.00',
            'total' => 'nullable|numeric|between:0.00,9999999.00',
            'user_name' => 'nullable|string|max:255',
            'user_email' => 'nullable|string|max:255',
            'user_mobile' => 'nullable|numeric|min:13',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(), HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $update_order = $order->update($request->all());

        if ($update_order) {
            $response = [
                'success' => true,
                'message' => "Order {$id} data has been successfully updated",
                'data' => $order
            ];
            return response()->json($response, HttpFoundationResponse::HTTP_OK);
        }

        else {
            $response = [
                'success' => false,
                'message' => "Failed! {$e->errorInfo}",
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
        $order = Order::find($id)->delete();
        $response = [
            'success' => true,
            'message' => "Order {$id} data has been successfully deleted",
            'data' => $order
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }
}
