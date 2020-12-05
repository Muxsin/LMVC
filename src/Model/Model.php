<?php

namespace LMVC\Model;

use LMVC\Database\ConnectionInterface;
use ReflectionClass;

abstract class Model
{
    abstract public function getFields(): array;

    public function getTable(): string
    {
        return lcfirst((new ReflectionClass($this))->getShortName()) . 's';
    }

    public function save(ConnectionInterface $connection) {
        $connection->insert($this->getTable(), $this->getFields());
    }
}
