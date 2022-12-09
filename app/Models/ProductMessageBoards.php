<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;//軟刪除指令

class ProductMessageBoards extends Model
{
    use HasFactory;
    use SoftDeletes;//軟刪除指令

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'content',
        'user_id',
        'content',
        'delete_at'//軟刪除必填欄位
    ];
}
