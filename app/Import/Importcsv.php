<?php

namespace App\Import;

use App\Post;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Importcsv implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        return new Post([
            'title' => $row['title'],
            'description' => $row['description'],
            'create_user_id' => 1,
            'updated_user_id' => 2,

        ]);

    }
}