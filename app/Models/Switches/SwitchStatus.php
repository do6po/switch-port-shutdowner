<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 07.12.18
 * Time: 13:28
 */

namespace App\Models\Switches;


class SwitchStatus
{
    const ONLINE = 'online';

    const OFFLINE = 'offline';

    protected $status;

    protected function __construct()
    {
    }

    public static function offline(): self
    {
        return (new self)->setStatusOffline();
    }

    public static function online(): self
    {
        return (new self)->setStatusOnline();
    }

    protected function setStatusOnline(): self
    {
        $this->status = self::ONLINE;

        return $this;
    }

    protected function setStatusOffline(): self
    {
        $this->status = self::OFFLINE;

        return $this;
    }
}