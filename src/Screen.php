<?php
namespace Phong;

use Phong\Entities\Drawable;

interface Screen
{
    /**
     * @return void
     */
    public function clear();

    /**
     * @param Drawable $entity
     * @return void
     */
    public function draw(Drawable $entity);

    /**
     * @return string
     */
    public function getHeight();

    /**
     * @return string
     */
    public function getWidth();
}
