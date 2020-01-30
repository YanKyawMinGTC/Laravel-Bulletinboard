<?php

namespace App\Http\Controllers\Post;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Models\CsvData;
use Illuminate\Http\Request;

class ImportController extends Controller
{

    public function getImport()
    {
        return view('post.import');
    }
    public function parseImport(Request $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));

        if (count($data) > 0) {
            $csv_data = array_slice($data, 0, 5);
            $csv_data_file = CsvData::create([
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_header' => $request->has('header'),
                'csv_data' => json_encode($data),
            ]);
        } else {
            return redirect()->back();
        }
        return view('post.import_fields', compact('csv_data', 'csv_data_file'));
    }
    public function processImport(Request $request)
    {
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        foreach ($csv_data as $row) {
            $contact = new Contact();
            foreach (config('app.db_fields') as $index => $field) {
                if ($data->csv_header) {
                    $contact->$field = $row[$request->fields[$field]];
                } else {
                    $contact->$field = $row[$request->fields[$index]];
                }
            }
            $contact->save();
        }
        return view('import_success');
    }

}
