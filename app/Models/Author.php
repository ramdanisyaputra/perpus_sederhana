<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $table = 'author';
    protected $guarded = [];

    public function buku()
    {
        return $this->HasMany(Buku::class);
    }
}
