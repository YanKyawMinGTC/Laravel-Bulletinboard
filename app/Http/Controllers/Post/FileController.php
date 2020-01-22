<?php

namespace App\Http\Controllers\Post;

use App\Export\ExportExcel;
use App\Import\Importcsv;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    public function import(Request $request)
    {

        Excel::import(new Importcsv, request()->file('file'));
        return redirect()->route('posts.index');
    }
    public function export()
    {
        return Excel::download(new ExportExcel, 'posts.xlsx');
    }
}
