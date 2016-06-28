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
     * @return int
     */
    public function getHeight(): int;

    /**
     * @return int
     */
    public function getWidth(): int;
}
