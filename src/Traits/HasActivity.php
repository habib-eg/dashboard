<?php

namespace Habib\Dashboard\Traits;

use Spatie\Activitylog\Traits\LogsActivity;

trait HasActivity{

    use LogsActivity;

    public function getDescriptionForEvent(string $eventName): string
    {
        $message=__('main.activity_description',['class'=>class_basename(static::class),'event'=>$eventName]);
        $user =auth()->user();
        return auth()->check() ? __('main.message_acticty_log', ['message' => $message, 'name' => $user->name, 'id' => $user->id]) : $message;
    }

}
