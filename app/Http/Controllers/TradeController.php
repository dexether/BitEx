<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Setting;
use App\Http\Models\Market;
use App\Http\Models\Order;

class TradeController extends Controller
{

	public function addOrder() {

	}

	public function cancelOrder() {

	}

	public function changeTheme() {
		if(Cookie::get('theme') == 'light') {
			Cookie::queue('theme', 'dark', 60*24*4);
		} else {
			Cookie::queue('theme', 'light', 60*24*4);
		}

		return redirect ('trade');
	}


	public function index()
	{

		// set this as service or only for exchange view
		if(empty(Cookie::get('theme'))) {
			// set cookie for color theme
			Cookie::queue('theme', 'light', 60*24*4);
		}
		//$settings = Setting::all()->keyBy('name');

		//$orderHistory
		//$openOrders
		//$pairs

		//$markets = Market::select('*')
		//->join('coins', 'coin2_id', '=', 'coins.id');
		//->keyBy('market_name');

		//$markets = Market::all()->keyBy('market_name');
		//foreach ($markets as $market) {
		//$pairs = Pair::where('market_id', $market->id);
		//}



		$settings = Setting::all();
		$markets = Market::all();
		$tradeHistory = Setting::all();
		$orderHistory = Setting::all();
		$orders = Order::all();

		$data = array(
			'settings' => $settings, // markets and its pairs
			'markets' => $markets, // markets and its pairs
			'tradeHistory' => $tradeHistory, // real time buy sells
			'orderHistory' => $orderHistory, // user order history
			'orders' => $orders, // buy sell orders
		);

		//return view('exchange/trade')->with('data', $data);

		$names = array('settings', 'orders', 'tradeHistory',
		'markets', 'orderHistory');
		return view('exchange/trade')->with(compact($names));
	}

}
