<?php
namespace Burbage\Core\Database\Cloneable\Operations\Common;

use Burbage\Core\Database\Connection\AbstractDatabaseConnection;

class FetchTablesOperation
{
    public function operate(AbstractDatabaseConnection $abstractDatabaseConnection)
    {
        $statement = $abstractDatabaseConnection
            ->getConnection()
            ->query(
                'SHOW TABLES;'
            );

        if (false === $statement) {
            throw new \Exception('unable.to.fetch.tables');
        }

        return $statement->fetchAll(\PDO::FETCH_COLUMN, 0);
    }
}
