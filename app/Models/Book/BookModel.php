<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookModel extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $fillable = [
                    'id',
                    'name',
                    'description',
                    'image',
                    'createdby',
                    'updatedby',
                    'created_at',
                    'updated_at' 
                ];
}
