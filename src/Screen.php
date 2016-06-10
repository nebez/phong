<?php
namespace Phong;

use Phong\Entities\Drawable;

interface Screen
{
    public function clear();

    public function draw(Drawable $entity);

    public function getHeight();

    public function getWidth();
}
