<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Models\Order;
use App\Http\Requests\OrderStoreRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{

  /**
   * Get a list of post
   * 
   * @param String $type
   * @return \Illuminate\Http\Response
   */
  public function get()
  {
    return new DataCollection(Order::get());
  }

  /**
   * Remove a Order
   *
   * @param  Order $order
   * @return \Illuminate\Http\Response
   */
  public function destroy(Order $order)
  {
    $order->delete();
    return response()->json('successfully deleted');
  }

  /**
   * Restore a deleted post
   *
   * @param  integer $id
   * @return \Illuminate\Http\Response
   */
  public function restore($id)
  {
    $order = Order::withTrashed()->findOrFail($id);
    $order->publish = 0; 
    $order->restore();
    return response()->json($order);
  }

}
