<?php


namespace Habib\Dashboard\Models;


use Habib\Dashboard\Traits\HasActivity;
use Habib\Dashboard\Traits\UuidTrait;

class Permission extends  \Spatie\Permission\Models\Permission{
    use UuidTrait,HasActivity;

}
