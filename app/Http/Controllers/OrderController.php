<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Events\OrderComplete;
use App\Http\Requests\OrderStoreRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
  /**
   * Store an order
   * 
   * @param  OrderStoreRequest $request
   * @return \Illuminate\Http\Response
   */

  public function store(OrderStoreRequest $request)
  { 
    $order = Order::create([
      'company' => $request->input('company'),
      'name' => $request->input('name'),
      'email' => $request->input('email'),
      'street' => $request->input('street'),
      'zip' => $request->input('zip'),
      'city' => $request->input('city'),
      'plate_front' => $request->input('plate_front'),
      'plate_back' => $request->input('plate_back'),
      'flag' => $request->input('flag'),  
    ]);
    event(new OrderComplete($order));
    return response()->json(200);
  }
}
