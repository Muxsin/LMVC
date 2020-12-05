<?php

namespace LMVC\Database;

interface ConnectionInterface
{
    public function connect();

    public function disconnect();

    public function query(string $query);

    public function insert(string $table, array $data);

    public function select(string $table, array $data);

    public function update(string $table, array $data);

    public function delete(string $table);
}
