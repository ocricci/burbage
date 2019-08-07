<?php
namespace Burbage\Core\Database\Connection;

use Burbage\Core\Database\Cloneable\CloneableDatabase;
use Burbage\Core\Database\Connection\Config\ConnectionConfigReader;

abstract class AbstractDatabaseConnection
{
    /**
     * @var \PDO
     */
    protected $connection;

    /**
     * @var CloneableDatabase
     */
    protected $cloneableDatabase;

    /**
     * @param string $databaseName
     */
    public function connect(string $databaseName)
    {
        $connectionParameters = $this->getConnectionParameters($databaseName);
        $this->connection = new \PDO(
            sprintf(
                'mysql:dbname=%s;host=%s',
                $databaseName,
                $connectionParameters['host']
            ),
            $connectionParameters['user'],
            $connectionParameters['password']
        );
    }

    public function setCloneableDatabase(CloneableDatabase $cloneableDatabase)
    {
        $this->cloneableDatabase = $cloneableDatabase;
    }

    public function getConnection() : \PDO
    {
        if (false == ($this->connection instanceof \PDO)) {
            throw new \Exception('connect.method.was.not.called');
        }

        return $this->connection;
    }

    protected function getConnectionParameters(string $databaseName) : array
    {
        return (new ConnectionConfigReader())
            ->readConfig(
                $databaseName,
                $this->getConnectionType()
            );
    }

    protected function getCloneableDatabase() : CloneableDatabase
    {
        if (false == ($this->cloneableDatabase instanceof CloneableDatabase)) {
            throw new \Exception('source.cloneable.database.is.not.set');
        }

        return $this->cloneableDatabase;
    }

    abstract function getConnectionType() : string;
}
