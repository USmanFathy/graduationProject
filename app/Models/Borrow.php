<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Borrow extends Model
{
    use HasFactory;
    protected $table ='borrow_request';
    protected $fillable =['product_id','user_id','from_date','to_date','status'];

    public function product():belongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function user():belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
