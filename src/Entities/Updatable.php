<?php
namespace Phong\Entities;

use Phong\State;

interface Updatable
{
    /**
     * @param State $state
     * @return void
     */
    public function update(State $state);
}
