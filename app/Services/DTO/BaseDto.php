<?php

namespace App\DTO;


class BaseDto
{
    /**
     * Create self object from array by class properties.
     * If not property in array - set default if exist in the class.
     *
     * @param array $data
     * @return static
     */
    public static function createFromArray(array $data): self
    {
        $dto = new static();

        foreach (get_class_vars(static::class) as $property => $defaultValue) {
            if (array_key_exists($property, $data)) {
                $dto->$property = $data[$property];
            }
        }

        return $dto;
    }

    /**
     * Create Array from object
     *
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
