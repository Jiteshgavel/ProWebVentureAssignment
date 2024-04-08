<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip',
        'url',
        'session_id',
        'user_id',
        'agent',
        'product_id'
    ];


    public function product(){
        return $this->belongsTo(Product::class);
    }

    public static function createViewLog($product_id=null)
    {
        $data = new ActivityLog();
        $data->url = \Request::url();
        $data->session_id = \Request::getSession()->getId();
        $data->user_id = (\Auth::check()) ? \Auth::id() : null;
        $data->ip = \Request::getClientIp();
        $data->product_id = $product_id;
        $data->agent = \Request::header('User-Agent');
        $data->save();
    }
}
