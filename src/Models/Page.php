<?php

namespace Code\Builder\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'decription',
        'page_url',
        'meta_title',
        'meta_description',
        'keywords',
        'status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function template()
    {
        return $this->hasOne(Template::class);
    }

}
