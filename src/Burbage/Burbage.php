<?php
namespace Burbage;

use Burbage\Core\Boot\Boot;
use DI\ContainerBuilder;
use Silly\Edition\PhpDi\Application;

class Burbage extends Application
{
    protected function createContainer()
    {
        $builder = new ContainerBuilder();
        //$builder->addDefinitions([]);

        return $builder->build();
    }

    public function boot()
    {
        (new Boot())->boot();
    }
}
