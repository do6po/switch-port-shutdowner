<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 07.12.18
 * Time: 13:36
 */

namespace App\Models\Switches;


class SwitchPortStatus
{
    const UP = 1;

    const DOWN = 2;

    protected $portIndex;

    protected $portStatus;

    protected function __construct(int $port)
    {
        $this->portIndex = $port;
    }

    public static function up(int $port): self
    {
        $self = new self($port);

        return $self->setUp();
    }

    protected static function down(int $port): self
    {
        $self = new self($port);

        return $self->setDown();
    }

    public function getPortIndex()
    {
        return $this->portIndex;
    }

    protected function setUp(): self
    {
        $this->portStatus = self::UP;

        return $this;
    }

    protected function setDown(): self
    {
        $this->portStatus = self::UP;

        return $this;
    }
}