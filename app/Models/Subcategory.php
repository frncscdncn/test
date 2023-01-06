<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Subsubcategory;

class Subcategory extends Model
{
    use HasFactory;

    public function Subsubcategories()
    {
        return $this->hasMany(Subsubcategory::class);
    }
}
