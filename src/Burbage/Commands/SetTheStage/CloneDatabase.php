<?php
namespace Burbage\Commands\SetTheStage;

use Symfony\Component\Console\Style\SymfonyStyle;

class CloneDatabase
{
    const COMMAND_TERM = 'clone databaseName';

    public function execute(string $databaseName, SymfonyStyle $io)
    {
        try {
            (new \Burbage\Core\SetTheStage\CloneDatabase\CloneDatabase())->execute($databaseName, $io);
            $io->success("Database {$databaseName} cloned !");
        } catch (\Exception $e) {
            $io->error($e->getMessage());
        }
    }
}
