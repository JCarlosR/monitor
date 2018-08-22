<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\Price;

class ItemController extends Controller
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
    	
    	return view('items.index', compact('items', 'search'));
    }

    public function store(Request $request)
    {
    	Item::create($request->all());
    	return back();
    }

    public function destroy(Item $item)
    {
    	if (Price::where('item_id', $item->id)->exists())
           $item->delete();
        else
           $item->forceDelete();

    	return back();
    }

    public function edit(Item $item)
    {        
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $item->update($request->only('name'));
        return redirect('/items');
    }
}
