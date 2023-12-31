<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Department extends Model
{
    use HasFactory, NodeTrait;

    protected $table = 'departments';
    protected $fillable =[
        'name',
        'description',
        'parent_id'
    ];
}
