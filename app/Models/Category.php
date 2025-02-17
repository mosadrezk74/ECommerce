<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'CategoryID';
    protected $table = 'Categories';
    public $timestamps = false;

    protected $fillable = [
        'CategoryName',
        'ParentCategoryID',
        'Description'
    ];

    // Self-referential relationship for parent/child categories
    public function parent()
    {
        return $this->belongsTo(Category::class, 'ParentCategoryID');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'ParentCategoryID');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'CategoryID');
    }
    use HasFactory;
}
