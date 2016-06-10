<?php
namespace Phong\Entities;

interface Drawable
{
    /**
     * @return array
     */
    public function getCoordinates(): array;

    /**
     * @return string
     */
    public function getDrawingCharacter(): string;
}
