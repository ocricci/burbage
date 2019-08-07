<?php
namespace Burbage\Core\Database\Cloneable;

class CloneableDatabase
{
    protected $cloneable = [
        'inoserver_prod',
        'wmsprod',
    ];

    protected $databaseName;

    public function __construct(string $databaseName)
    {
        if (false == $this->isCloneable($databaseName)) {
            throw new \Exception(
                "Database {$databaseName} is not cloneable ! Please, configure."
            );
        }

        $this->databaseName = $databaseName;
    }

    public function isCloneable(string $databaseName)
    {
        return in_array($databaseName, $this->cloneable);
    }
}
