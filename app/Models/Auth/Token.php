<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 07.12.18
 * Time: 8:14
 */

namespace App\Models\Auth;


/**
 * Class Token
 * @package App\Models\Auth
 */
class Token
{
    private $token;

    public function compare(string $token): bool
    {
        return $this->token === $token;
    }

    public static function create(string $token): self
    {
        $self = new self;
        $self->token = $token;

        return $self;
    }

    public function __toString()
    {
        return $this->token;
    }
}