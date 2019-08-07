<?php
namespace Burbage\Core\Database\Cloneable\Operations\Source;

use Burbage\Core\Database\Connection\Source\SourceConnectionInterface;

class ShowCreateTableOperation
{
    public function operate(
        SourceConnectionInterface $sourceConnection,
        string $tableName
    ) {
        $stmt = $sourceConnection
            ->getConnection()
            ->query(
                sprintf(
                    "SHOW CREATE TABLE %s;",
                    $tableName
                )
            );

        return $stmt->fetchColumn(0);
    }
}