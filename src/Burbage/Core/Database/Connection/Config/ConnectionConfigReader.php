<?php
namespace Burbage\Core\Database\Connection\Config;

use Symfony\Component\Yaml\Yaml;

class ConnectionConfigReader
{
    public function readConfig(string $databaseName, string $configType)
    {
        $parsedData = Yaml::parseFile(
            sprintf(
                "%s/config/databases/connection/%s.yml",
                APP_DIR,
                $configType
            )
        );

        return $parsedData[$databaseName];
    }
}
