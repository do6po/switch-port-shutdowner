<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 07.12.18
 * Time: 13:50
 */

namespace App\Collections;


use App\Exceptions\Collections\NotAllowedTypeException;
use Illuminate\Support\Collection;

class NamedCollection extends Collection
{
    protected $name;

    /**
     * NamedCollection constructor.
     * @param array $items
     * @throws NotAllowedTypeException
     */
    public function __construct($items = [])
    {
        $this->checkInstance($items);
        parent::__construct($items);
    }

    /**
     * @param $items
     * @throws NotAllowedTypeException
     */
    protected function checkInstance($items)
    {
        foreach ($items as $item) {
            if (!($item instanceof $this->name)) {
                throw new NotAllowedTypeException();
            }
        }
    }
}