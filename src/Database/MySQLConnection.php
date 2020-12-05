<?php

namespace LMVC\Database;

use mysqli;

class MySQLConnection implements ConnectionInterface
{
    /**
     * @var mysqli|null
     */
    private $connection;
    private $connected;
    private $hostname;
    private $username;
    private $password;
    private $database;
    private $port;

    public function __construct(string $hostname, string $username, string $password, string $database, int $port)
    {
        $this->connected = false;
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->port = $port;
    }

    public function connect()
    {
        $this->connection = new mysqli($this->hostname, $this->username, $this->password, $this->database, $this->port);
    }

    public function disconnect()
    {
        $this->connection->close();
    }

    public function query(string $query)
    {
        return $this->connection->query($query);
    }

    public function insert(string $table, array $data)
    {
        $fields = array_keys($data);
        $values = array_map(function ($value) {
            return json_encode($value);
        }, array_values($data));
        $query = 'insert into ' . $table . '(' . implode(',', $fields) . ') values(' . implode(',', $values) . ')';

        return $this->query($query);
    }

    public function select(string $table, array $data)
    {
        $fields = $data;
        $query = 'select ' . implode(',', $fields) . ' from ' . $table;

        return $this->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function update(string $table, array $data)
    {
        $changes = array_map(function ($key, $value) {
            return $key . '=' . json_encode($value);
        }, $data);
        $query = 'update ' . $table . ' set ' . implode(',', $changes);

        return $this->query($query);
    }

    public function delete(string $table)
    {
        $query = 'delete from ' . $table;

        return $this->query($query);
    }
}
