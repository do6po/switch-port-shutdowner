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

    const UNKNOWN = 0;

    protected $portIndex;

    protected $portStatus;

    protected function __construct(int $port)
    {
        $this->portIndex = $port;
    }

    public static function create(int $port, int $status)
    {
        if ($status === self::UP) {
            return self::up($port);
        }

        return self::down($port);
    }

    public static function up(int $port): self
    {
        $self = new self($port);

        return $self->setUp();
    }

    public static function down(int $port): self
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