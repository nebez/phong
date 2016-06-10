<?php
namespace Phong;

use Phong\Entities\Drawable;

class CliScreen implements Screen
{
    private $lastDraw;

    public function __construct()
    {
        $this->lastDraw = microtime(true);
    }

    public function clear()
    {
        fwrite(STDOUT, shell_exec('tput reset'));

        // Calculate and print FPS
        fwrite(STDOUT, shell_exec('tput cup 0 2'));
        fwrite(STDOUT, 'FPS: ' . $this->getFps());
    }

    public function draw(Drawable $entity)
    {
        $coordinates = $entity->getCoordinates();


        foreach (range($coordinates['y'], $coordinates['y'] + $coordinates['h'] - 1) as $y) {
            fwrite(STDOUT, shell_exec('tput cup ' . $y . ' ' . $coordinates['x']));

            foreach (range($coordinates['x'], $coordinates['x'] + $coordinates['w'] - 1) as $x) {
                fwrite(STDOUT, $entity->getDrawingCharacter());
            }
        }

        // Set the cursor to the top left of the window to prevent having
        // a weird cursor flicker follow the last drawn element
        fwrite(STDOUT, shell_exec('tput cup 0 0'));
    }

    public function getHeight()
    {
        return shell_exec('tput lines');
    }

    public function getWidth()
    {
        return shell_exec('tput cols');
    }

    private function getFps()
    {
        $now = microtime(true);
        $duration = $now - $this->lastDraw;
        $this->lastDraw = $now;

        return number_format(1 / $duration, 3);
    }
}
