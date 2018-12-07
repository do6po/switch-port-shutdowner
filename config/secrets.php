<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 06.12.18
 * Time: 19:00
 */

$secrets = explode(',', env('SECRET_TOKENS'));

if ($secrets[0] == '') {
    return [];
}

return $secrets;