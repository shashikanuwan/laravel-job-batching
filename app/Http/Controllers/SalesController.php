<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        return view('upload-file');
    }

    public function upload(Request $request)
    {
        if (request()->has('mycsv')) {
            $data = file(request()->mycsv);

            //chunking file
            $chunks = array_chunk($data, 1000);

            //convert 1000 records new csv
            foreach ($chunks as $key => $chunk) {
                $name = "/tmp{$key}.csv";
                $path = resource_path('temp');

                file_put_contents($path . $name, $chunk);
            }
            return 'Done';
        }
        return 'error';
    }

    public function store(Request $request)
    {
        $path = resource_path('temp');
        $files = glob("$path/*.csv");

        $header = [];
        foreach ($files as $key => $file) {
            $data = array_map('str_getcsv', file($file));
            if ($key === 0) {
                $header = $data[0];
                unset($data[0]);
            }
            foreach ($data as $value) {
                $saleData = array_combine($header, $value);
                Sale::create($saleData);
            }
        }
        return 'Stored';
    }
}
