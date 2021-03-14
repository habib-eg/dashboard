<?php


namespace Habib\Dashboard\Models;


use Habib\Dashboard\Traits\HasActivity;
use Habib\Dashboard\Traits\UuidTrait;

class Role extends  \Spatie\Permission\Models\Role{
    use UuidTrait,HasActivity;

}
