<?php
namespace Burbage\Commands;

use Burbage\Commands\SetTheStage\CloneDatabase;

class Commands
{
    public static function getAvailable() : array
    {
        return [
            CloneDatabase::COMMAND_TERM => CloneDatabase::class,
        ];
    }
}
