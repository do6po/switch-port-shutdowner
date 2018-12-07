<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 07.12.18
 * Time: 13:52
 */

namespace App\Exceptions\Collections;


class NotAllowedTypeException extends \Exception
{
    protected $message = 'This type object not allowed';
}