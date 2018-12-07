<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 07.12.18
 * Time: 8:13
 */

namespace App\Collections\Auth;


use App\Collections\NamedCollection;
use App\Models\Auth\Token;

class TokenCollection extends NamedCollection
{
    protected $class = Token::class;
}