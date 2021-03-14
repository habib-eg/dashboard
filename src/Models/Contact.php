<?php

namespace  Habib\Dashboard\Models;

use Habib\Dashboard\Traits\HasActivity;
use Habib\Dashboard\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Contact extends Model
{
    use UuidTrait, HasActivity;
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'email','title', 'phone', 'message', 'contactable', 'done'
    ];
    /**
     * @var array
     */
    protected $casts = [
        'done' => 'boolean'
    ];

    /**
     * @return MorphTo
     */
    public function contactable()
    {
        return $this->morphTo();
    }

}
