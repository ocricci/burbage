<?php
namespace Burbage\Core\Database\Connection\Source;

interface SourceConnectionInterface
{
    public function getConnection() : \PDO;
    public function fetchCloneableTablesAsCommand() : \Generator;
}
