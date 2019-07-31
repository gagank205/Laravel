<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CsvFile extends Controller
{
    public function csv_import()
    {
    	return Excel::download(new CsvExport, 'user.csv');
    }
}
