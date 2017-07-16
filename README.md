# Frankie Modular

The base frankie module system

```
$container = new CompositeContainer();
$modules = new Loader($container);

// add modules
$modules->add(new Corley\Module\FrameworkModule());

$loader->getContainer()->get("event_manager");
```

## Create a module

It is just a class that implements `Corley\Modular\Module\ModuleInterface`

```php
class Framework implements ModuleInterface
{
    public function getContainer()
    {
        return /* Psr\Container\ContainerInterface instance */
    }
}
```

