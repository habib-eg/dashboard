<?php


namespace Habib\Dashboard\Traits;

//

/**
 * Trait HasImage
 * @package Habib\Dashboard\Traits
 */
trait HasImage
{

    protected function initializeHasImage(): void
    {
        foreach ($this->fields() as $field) {
            $hasField = isset($this->ImageFields()[$field]);
            $valueField = $this->ImageFields()[$field] ?? null;

            if ($hasField && $valueField === $this->stringWord()) {
                $this->{$field . '_path'} = asset($this->{$field} ?? $this->defaultImage());
                $this->appends[] = $field . '_path';
            }

            if ($hasField && $valueField === $this->stringWord()) {
                $this->{$field . '_path'} = array_map(function ($object) {
                    return asset($object ?? $this->defaultImage());
                }, $this->{$field});
                $this->mergeCasts([
                    $field => 'array'
                ]);
                $this->appends[] = $field . '_path';
            }
        }

    }

    /**
     * @return array
     */
    private function fields(): array
    {
        $fields =
            collect($this->getFillable())->filter(function ($field) {
                return in_array($field, $this->ImageFields()) && property_exists($this, $field);
            })->values();
        return $fields->toArray();
    }

    /**
     * @return array
     */
    protected function ImageFields(): array
    {
        return [
            'image' => $this->stringWord(),
            'images' => $this->arrayWord(),
            'photo' => $this->stringWord(),
            'photos' => $this->arrayWord(),
        ];
    }

    /**
     * @return string
     */
    protected function stringWord(): string
    {
        return 'string';
    }

    /**
     * @return string
     */
    protected function arrayWord(): string
    {
        return 'array';
    }

    /**
     * @return string
     */
    public function defaultImage():string
    {
        return "default.png";
    }

}
