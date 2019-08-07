<?php
namespace Burbage\Core\Database\Cloneable\Operations\Target;

use Burbage\Core\Database\Connection\Target\TargetConnectionInterface;

class DisableForeignKeysOperation
{
    public function operate(TargetConnectionInterface $targetConnection)
    {
        $targetConnection
            ->getConnection()
            ->exec(
                "SET FOREIGN_KEY_CHECKS = 0;"
            );
    }
}
