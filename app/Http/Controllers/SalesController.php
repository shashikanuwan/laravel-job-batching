<?php

namespace App\Http\Controllers;

use App\Jobs\SalesCsvProcess;
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

            $chunks = array_chunk($data, 1000);
            $path = resource_path('temp');

            foreach ($chunks as $key => $chunk) {
                $name = "/tmp{$key}.csv";

                file_put_contents($path . $name, $chunk);
            }

            $files = glob("$path/*.csv");

            $header = [];
            foreach ($files as $key => $file) {
                $data = array_map('str_getcsv', file($file));
                if ($key === 0) {
                    $header = $data[0];
                    unset($data[0]);
                }
                SalesCsvProcess::dispatch($data, $header);
                unlink($file);
            }
            return 'Done';
        }
        return 'error';
    }
}
