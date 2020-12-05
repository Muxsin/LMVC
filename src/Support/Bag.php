<?php

namespace LMVC\Support;

use ArrayAccess;
use ArrayIterator;
use Exception;
use IteratorAggregate;
use Traversable;

class Bag implements ArrayAccess, IteratorAggregate
{
    private $bag;

    public function __construct()
    {
        $this->bag = [];
    }

    public static function createFromArray(array $array): self
    {
        $bag = new static();
        $bag->bag = $array;

        return $bag;
    }

    public function all(): array
    {
        return $this->bag;
    }

    public function has(string $key): bool
    {
        return isset($this->bag[$key]);
    }

    public function get(string $key, $default = null)
    {
        if ($this->has($key)) {
            return $this->bag[$key];
        }

        return $default;
    }

    /**
     * @param string[] $keys
     * @return array
     */
    public function getMany(array $keys): array
    {
        $result = [];

        foreach ($keys as $key) {
            if ($this->has($key)) {
                $result[$key] = $this->get($key);
            }
        }

        return $result;
    }

    public function set(string $key, $value): self
    {
        $this->bag[$key] = $value;

        return $this;
    }

    public function unset(string $key): self
    {
        if ($this->has($key)) {
            unset($this->bag[$key]);
        }

        return $this;
    }

    public function offsetExists($offset): bool
    {
        return $this->has($offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    public function offsetUnset($offset)
    {
        $this->unset($offset);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->bag);
    }
}
