<?php

namespace App\Import;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class Importcsv implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    public function model(array $row)
    {
        return new Post([
            'title' => $row['title'],
            'description' => $row['description'],
            'create_user_id' => auth()->user()->id,
            'updated_user_id' => auth()->user()->id,
            'created_at' => now(),
        ]);
    }
    public function rules(): array
    {
        return [
            'title' => "required",
            'description' => "required",
        ];
    }
    /**
     * @return array
     */
    public function customValidationAttributes()
    {
        return ['title' => 'title none!'];
    }
}
