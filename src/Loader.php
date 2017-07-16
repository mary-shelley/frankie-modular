<?php
namespace Corley\Modular;

use Acclimate\Container\CompositeContainer;
use Corley\Modular\Module\ModuleInterface;

use Psr\Container\ContainerInterface;

class Loader
{
    private $container;

    public function __construct(CompositeContainer $container)
    {
        $this->container = $container;
    }

    public function add(ModuleInterface $module)
    {
        $container = $module->getContainer();

        if ($container instanceOf ContainerInterface) {
            $this->container->addContainer($container);
        }
    }

    public function prepare(callable $repository)
    {
        $modules = $repository($this->container);
        foreach ($modules as $module) {
            $this->add($module);
        }
    }

    public function getContainer()
    {
        return $this->container;
    }
}
