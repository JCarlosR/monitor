<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Price;
use App\Item;
use App\Exports\PricesExport;

use Excel;

class PriceController extends Controller
{

    public function store(Request $request)
    {
        $rules = [
            'location_id' => 'required',
            'item_id' => 'required'
        ];
        $messages = [
            'location_id.required' => 'Es obligatorio seleccionar una ubicación.',
            'item_id.required' => 'Es obligatorio seleccionar un ítem.'
        ];
        $this->validate($request, $rules, $messages);

    	$data = $request->all();
    	$data['user_id'] = auth()->user()->id;

    	Price::create($data);
    	return back();
    }

    public function destroy(Price $price)
    {
    	$price->delete();
    	return back();
    }

    public function download(Item $item) 
    {
        $fileName = "Detalles del ítem $item->name.xlsx";
        $export = new PricesExport($item->id);
        return Excel::download($export, $fileName);
    }
}
