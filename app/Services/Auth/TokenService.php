<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 07.12.18
 * Time: 8:03
 */

namespace App\Services\Auth;


use App\Http\Requests\Switches\HandlerRequest;
use App\Models\Auth\Token;
use App\Repositories\Auth\TokenRepository;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class TokenService
{
    /**
     * @var TokenRepository
     */
    protected $repository;

    public function __construct(TokenRepository $repository)
    {
        $this->repository = $repository;
    }

    public function validate(HandlerRequest $request)
    {
        $userToken = Token::create($request->get('token'));
        $tokens = $this->repository->getAll();
        foreach ($tokens as $token) {
            if ($token->compare($userToken)) {
                return true;
            }
        }

        throw new AccessDeniedException('Access deny for this page');
    }
}