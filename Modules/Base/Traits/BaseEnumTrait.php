<?php

namespace Modules\Base\Traits;

trait BaseEnumTrait
{
    public static function values() :array
    {
        return array_map(fn ($item) => $item->value , self::cases());
    }

    /**
     * @param $enValue
     * @return string|null
     */
    static function getTitleByValue($enValue): ?string
    {
        $result = null;

        foreach (self::cases() as $value) {
            if ($value->value === $enValue->value) {
                $result = $value->title();
            }
        }

        return $result;
    }

    public function getData()
    {
        return [
            'title' => $this->getTitleByValue($this),
            'value' => $this,
        ];
    }
}
