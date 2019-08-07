<?php
namespace Burbage\Core\Database\Cloneable\Operations\Target;

class CreateDatabaseOperation
{
    public function operate(
        string $databaseName,
        array $connectionParameters = []
    ) {
        $tempConnection = new \PDO(
            sprintf(
                "mysql:host=%s",
                $connectionParameters['host']
            ),
            $connectionParameters['user'],
            $connectionParameters['password']
        );

        $tempConnection->exec("CREATE DATABASE {$databaseName};");
        $tempConnection = null;
        return;
    }
}
