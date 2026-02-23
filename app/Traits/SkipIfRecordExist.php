<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait SkipIfRecordExist
{
    /**
     * @param class-string<Model> $modelClass
     * @return bool
     */
    protected function skipIfRecordExist(string $modelClass)
    {
        return $modelClass::count() > 0;

    }
}
