<?php
namespace Corley\Modular;

use PHPUnit\Framework\TestCase;
use Acclimate\Container\CompositeContainer;
use Psr\Container\ContainerInterface;
use Corley\Modular\Module\ModuleInterface;

class LoaderTest extends TestCase
{
    public function testAddContainers()
    {
        $clazz = new \stdClass;

        $container = $this->prophesize(ContainerInterface::class);
        $container->has("test")->willReturn(true);
        $container->get("test")->willReturn($clazz);

        $module = $this->prophesize(ModuleInterface::class);
        $module->getContainer()->willReturn($container->reveal());

        $container = new CompositeContainer();
        $loader = new Loader($container);
        $loader->add($module->reveal());

        $result = $loader->getContainer()->get("test");

        $this->assertSame($clazz, $result);
    }

    public function testSkipAddContainer()
    {
        $module = $this->prophesize(ModuleInterface::class);
        $module->getContainer()->willReturn(null);

        $container = new CompositeContainer();
        $loader = new Loader($container);

        // container is null
        $loader->add($module->reveal());

        $this->assertTrue(true);
    }

    public function testAddAll()
    {
        $clazz = new \stdClass;

        $container = $this->prophesize(ContainerInterface::class);
        $container->has("test")->willReturn(true);
        $container->get("test")->willReturn($clazz);

        $module = $this->prophesize(ModuleInterface::class);
        $module->getContainer()->willReturn($container->reveal());

        $container = new CompositeContainer();
        $loader = new Loader($container);
        $loader->prepare(function($container) use ($module) {
            return [$module->reveal()];
        });

        $result = $loader->getContainer()->get("test");

        $this->assertSame($clazz, $result);
    }
}
