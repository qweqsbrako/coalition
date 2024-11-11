<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class ProductController extends Controller
{
    //
    private $filePath = 'storage/data.json';

    public function index()
    {
        return view('products.index');
    }

    public function loadData()
    {
        $data = $this->getData();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = $this->getData();

        $entry = [
            'id' => uniqid(),
            'product_name' => $request->product_name,
            'quantity_in_stock' => $request->quantity_in_stock,
            'price_per_item' => $request->price_per_item,
            'datetime_submitted' => Carbon::now()->toDateTimeString(),
            'total_value' => $request->quantity_in_stock * $request->price_per_item
        ];

        $data[] = $entry;
        $this->saveData($data);

        return response()->json(['success' => true, 'data' => $entry]);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData();

        foreach ($data as &$entry) {
            if ($entry['id'] == $id) {
                $entry['product_name'] = $request->product_name;
                $entry['quantity_in_stock'] = $request->quantity_in_stock;
                $entry['price_per_item'] = $request->price_per_item;
                $entry['total_value'] = $request->quantity_in_stock * $request->price_per_item;
                break;
            }
        }

        $this->saveData($data);

        return response()->json(['success' => true, 'data' => $entry]);
    }

    private function getData()
    {
        if (File::exists($this->filePath)) {
            $jsonData = File::get($this->filePath);
            return json_decode($jsonData, true) ?? [];
        }

        return [];
    }

    private function saveData($data)
    {
        File::put($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
    }

}
