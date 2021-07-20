<?php

namespace App\Models\Traits;

trait Relations
{
    public function belongsTo($related)
    {
        $instance = $this->getRelatedInstance($related);

        var_dump($instance);
    }

    private function getRelatedInstance($related)
    {
        return new $related;
    }
}