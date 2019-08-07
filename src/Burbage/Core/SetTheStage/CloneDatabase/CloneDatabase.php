<?php
namespace Burbage\Core\SetTheStage\CloneDatabase;

use Burbage\Core\Database\Cloneable\CloneableDatabase;
use Burbage\Core\Database\Connection\Source\SourceConnection;
use Burbage\Core\Database\Connection\Target\TargetConnection;

class CloneDatabase
{
    public function execute(string $databaseName)
    {
        $cloneable = new CloneableDatabase($databaseName);

        $sourceConnection = new SourceConnection();
        $sourceConnection->connect($databaseName);
        $sourceConnection->setCloneableDatabase($cloneable);

        $targetConnection = new TargetConnection();
        $targetConnection->connectOrCreate($databaseName);
        $targetConnection->disableForeignKeys();
        foreach ($sourceConnection->fetchCloneableTablesAsCommand() as $command) {
            $x = $command;
            $targetConnection
                ->getConnection()
                ->exec($command);
        }

        $targetConnection->enableForeignKeys();
    }
}
