<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Item;
use App\Price;

class MonitorController extends Controller
{
    public function index(Request $request)
    {
    	$search = $request->input('search');
    	if ($search) {
    		$query = '%' . $search . '%';
    		$items = Item::where('name', 'like', $query)->orderBy('name')->paginate(10);
    	} else {
    		$items = Item::orderBy('name')->paginate(10);	
    	}

    	$endDate = Carbon::now(); 
    	$startDate = Carbon::now()->subDays(7);

    	$itemId = $request->input('item_id');
    	if ($itemId) {
    		$prices = Price::where('item_id', $itemId)
	    		->whereBetween('created_at', [$startDate, $endDate])
	    		->get();
    	} else {
    		$prices = [];
    	}

    	return view('monitor.index', compact('search', 'items', 'prices', 'startDate', 'endDate', 'itemId'));
    }
}
