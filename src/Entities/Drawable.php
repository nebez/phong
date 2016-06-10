<?php
namespace Phong\Entities;

interface Drawable
{
    /**
     * @return array
     */
    public function getCoordinates();

    /**
     * @return string
     */
    public function getDrawingCharacter();
}
