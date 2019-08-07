<?php
namespace Burbage\Core\Database\Connection\Target;

interface TargetConnectionInterface
{
    public function connectOrCreate(string $databaseName);
    public function getConnection() : \PDO;
    public function disableForeignKeys();
    public function enableForeignKeys();
}