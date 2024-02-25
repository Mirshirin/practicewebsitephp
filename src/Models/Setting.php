<?php

namespace  App\Models;

use App\Entities\SettingEntity;

class setting extends Model{
    protected $fileName = 'setting';
    protected $entityClass = SettingEntity::class;
}