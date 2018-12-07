<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 07.12.18
 * Time: 8:08
 */

namespace App\Repositories\Auth;


use App\Collections\Auth\TokenCollection;
use App\Models\Auth\Token;

class TokenRepository
{
    /**
     * @return TokenCollection|Token[]
     */
    public function getAll(): TokenCollection
    {
        $tokenArray = config('secrets');
        return $this->map($tokenArray);
    }

    /**
     * @param array $tokenArray
     * @return TokenCollection|Token[]
     */
    private function map(array $tokenArray): TokenCollection
    {
        $result = [];

        foreach ($tokenArray as $token) {
            $result[] = Token::create($token);
        }

        return new TokenCollection($result);
    }
}