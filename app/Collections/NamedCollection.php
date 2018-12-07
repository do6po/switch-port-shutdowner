<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 07.12.18
 * Time: 13:50
 */

namespace App\Collections;


use App\Exceptions\Collections\NotAllowedTypeException;
use App\Exceptions\Collections\NotFoundClassException;
use Illuminate\Support\Collection;

/**
 * Class NamedCollection
 * @package App\Collections
 */
abstract class NamedCollection extends Collection
{
    /**
     * Class namespace
     *
     * @var string
     */
    protected $class;

    /**
     * NamedCollection constructor.
     *
     * @param array $items
     * @throws NotAllowedTypeException
     * @throws NotFoundClassException
     */
    public function __construct($items = [])
    {
        $this->checkClassNamespace();
        $this->checkInstances($items);

        parent::__construct($items);
    }

    /**
     * @param $items
     * @throws NotAllowedTypeException
     */
    protected function checkInstances($items)
    {
        foreach ($items as $item) {
            $this->checkInstance($item);
        }
    }

    /**
     * @param $item
     * @throws NotAllowedTypeException
     */
    protected function checkInstance($item): void
    {
        if (!($item instanceof $this->class)) {
            throw new NotAllowedTypeException();
        }
    }

    /**
     * @throws NotFoundClassException
     */
    protected function checkClassNamespace()
    {
        if (empty($this->class)) {
            throw new NotFoundClassException('Class must be filled');
        }
    }
}