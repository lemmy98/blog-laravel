<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    use HasFactory;

//    protected $table = 'articles';

    protected $fillable = [
        "title",
        "body",
        "status",
        "published_at",
        "user_id",
    ];
    /**
     * @var mixed
     */
    private $title;

    public function user(){
        return $this->belongsTo(User::class);
    }

}
