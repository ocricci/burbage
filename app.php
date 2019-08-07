#!/usr/bin/env php
<?php
require_once 'vendor/autoload.php';

$app = new \Burbage\Burbage();
$app->boot();

define('APP_DIR', __DIR__);

foreach (\Burbage\Commands\Commands::getAvailable() as $commandTerm => $commandClass) {
    $app->command($commandTerm, [new $commandClass(), 'execute']);
}

$app->run();
exit;
