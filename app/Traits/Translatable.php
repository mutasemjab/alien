<?php

namespace App\Traits;

trait Translatable
{
    public function trans(string $field): string
    {
        $locale = app()->getLocale();
        $key    = $field . '_' . $locale;
        return $this->$key ?? $this->{$field . '_en'} ?? '';
    }
}
