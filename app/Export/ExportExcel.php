<?php

namespace App\Export;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportExcel implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Post::select(
            'posts.title',
            'posts.description',
            'users.name',
            'posts.created_at')
            ->join('users', 'users.id', 'posts.create_user_id')
            ->orderBy('posts.updated_at', 'DESC')
            ->get();
    }
    public function headings(): array
    {
        return [
            'Post Title',
            'Post Description',
            'Posted User',
            'Posted Date',
        ];
    }
}
