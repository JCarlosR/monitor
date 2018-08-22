<?php namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

use App\Price;
use Carbon\Carbon;

class PricesExport implements FromCollection, WithHeadings, WithMapping
{
	private $itemId;

	public function __construct($itemId) 
	{
		$this->itemId = $itemId;
	}

	public function headings(): array
    {
        return [
            'Ubicación',
            'Ítem',
            'Usuario',
            'Valor cargado',
            'Fecha de registro'
        ];
    }

    public function collection()
    {
    	$endDate = Carbon::now(); 
    	$startDate = Carbon::now()->subDays(7);

        return Price::with('location', 'item', 'user')
	        ->whereBetween('created_at', [$startDate, $endDate])
	        ->where('item_id', $this->itemId)->get([
	        	'location_id',
	        	'item_id',
	        	'user_id',
	        	'value',
	        	'created_at'
	        ]);
    }

    public function map($price): array
    {
    	return [
    		$price->location->name,
    		$price->item->name,
    		$price->user->name,
    		$price->value,
    		$price->created_at
    	];
    }
}
