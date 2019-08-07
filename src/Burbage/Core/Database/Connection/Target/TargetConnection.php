<?php
namespace Burbage\Core\Database\Connection\Target;

use Burbage\Core\Database\Cloneable\Operations\Target\CreateDatabaseOperation;
use Burbage\Core\Database\Cloneable\Operations\Target\DisableForeignKeysOperation;
use Burbage\Core\Database\Cloneable\Operations\Target\EnableForeignKeysOperation;
use Burbage\Core\Database\Connection\AbstractDatabaseConnection;

class TargetConnection extends AbstractDatabaseConnection implements TargetConnectionInterface
{
    const CONNECTION_TYPE = 'target';

    const UNKNOWN_DATABASE_EXCEPTION_CODE = 1049;

    function getConnectionType() : string
    {
        return self::CONNECTION_TYPE;
    }

    public function connectOrCreate(string $databaseName)
    {
        try {
            $this->connect($databaseName);
        } catch (\PDOException $PDOException) {
            if ($PDOException->getCode() == self::UNKNOWN_DATABASE_EXCEPTION_CODE) {
                $this->create($databaseName);
                $this->connect($databaseName);
                return;
            }

            throw $PDOException;
        }
    }

    protected function create(string $databaseName)
    {
        (new CreateDatabaseOperation())->operate(
            $databaseName,
            $this->getConnectionParameters($databaseName)
        );

        return;
    }

    public function disableForeignKeys()
    {
        (new DisableForeignKeysOperation())->operate($this);
    }

    public function enableForeignKeys()
    {
        (new EnableForeignKeysOperation())->operate($this);
    }
}
