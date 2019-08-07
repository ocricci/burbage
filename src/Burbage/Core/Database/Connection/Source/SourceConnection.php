<?php
namespace Burbage\Core\Database\Connection\Source;

use Burbage\Core\Database\Cloneable\Operations\Common\FetchTablesOperation;
use Burbage\Core\Database\Cloneable\Operations\Source\ShowCreateTableOperation;
use Burbage\Core\Database\Connection\AbstractDatabaseConnection;

class SourceConnection extends AbstractDatabaseConnection implements SourceConnectionInterface
{
    const CONNECTION_TYPE = 'source';

    function getConnectionType() : string
    {
        return self::CONNECTION_TYPE;
    }

    public function fetchCloneableTablesAsCommand() : \Generator
    {
        foreach ((new FetchTablesOperation())->operate($this) as $tableName) {
            yield (new ShowCreateTableOperation())->operate($this, $tableName);
        }
    }
}
