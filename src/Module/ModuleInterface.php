<?php
namespace Corley\Modular\Module;

interface ModuleInterface
{
    /**
     * @return Psr\Container\ContainerInterface
     */
    public function getContainer();
}
