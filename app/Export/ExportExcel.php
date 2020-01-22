<?php

namespace App\Export;

use App\Post;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportExcel implements FromCollection
{
    public function collection()
    {
        return Post::all();
    }
}
