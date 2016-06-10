<?php
namespace Phong\Entities;

use Phong\State;

interface Updatable
{
    public function update(State $state);
}
