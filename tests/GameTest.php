<?php
namespace Phong\Tests;

use PHPUnit\Framework\TestCase;
use Phong\CliScreen;
use Phong\Game;
use Phong\State;

class GameTest extends TestCase 
{
    /** 
     * @var Game 
     */
    protected $game;

    /**
     * @return void
     */
    public function setUp()
    {
        $this->game = new Game(new State());
    }

    /** @test */
    public function a_games_state_is_stopped_by_default()
    {
    	$this->assertTrue($this->game->getState()->is(State::STOPPED));
    }

    /** @test */
    public function a_game_can_be_started()
    {
    	$this->game->setOutput(new CliScreen());

    	$this->game->start();

    	$this->assertTrue($this->game->isRunning());
    }

    /** @test */
    public function a_game_can_be_paused()
    {
    	$this->game->pause();

    	$this->assertTrue($this->game->getState()->is(State::PAUSED));
    }

    /** @test */
    public function a_game_can_be_stopped()
    {
    	$this->game->setOutput(new CliScreen());

    	$this->game->start();

    	$this->assertTrue($this->game->isRunning());

    	$this->game->stop();

    	$this->assertTrue($this->game->getState()->is(State::STOPPED));
    }

    /** @test */
    public function it_correctly_calculates_refresh_rate()
    {
    	$refreshRate = 60;

    	$this->game->setRefreshRate($refreshRate);

    	$this->assertEquals($this->game->getRefreshRate(), 1000000 / $refreshRate);
    } 
}
