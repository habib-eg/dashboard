<?php

namespace Habib\Dashboard\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait HasUser{

    protected static function userIdField():string { return  User::USER_ID ?? 'user_id'; }

    protected static function userIdDefaultValue() { return auth()->check() ? auth()->id() : null; }

    protected static function bootHasUser(){
        static::creating(function ($model) {
            $model->{self::userIdField()} = $model->{self::userIdField()} ?? self::userIdDefaultValue();
        });
    }

    public function scopeOwn(Builder $builder,$user_id=null){
        $user_id = $user_id ?? (auth()->check() ? auth()->id() : null);
        return $builder->where(static::userIdField(),$user_id ??  self::userIdDefaultValue() );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
