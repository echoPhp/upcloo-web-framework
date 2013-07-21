# UpCloo MicroFramework with ZF2 components

This is just a simple microframework based on ZF2 components.

## Considerations

Actually the source code is quite a bit messy (App.php)... I'm working on the
framework requirements and validating the reality that we need a custom
framework.

## License

This project is released under MIT license.

##Getting started

In the `scenario` folder you can find an example but a tipical starting point
can be something like this...

You can use a project folder that you prefer but a good starting point is:

     - src
       - Your
         - Namespace
     - tests
       - Your
         - Namespace
     - web
     - configs

The entry point (web/index.php)

```
<?php
$loader = include __DIR__ . '/vendor/autoload.php';

$loader->add("Your", __DIR__ . '/../src');

$conf = include __DIR__ . '/../configs/app.php';
$app = new \UpCloo\App($conf);
$app->bootstrap()->run();
```

Here is a config (configs/app.php)

```
<?php
return array(
    "router" => array(
        "routes" => array(
            "home" => array(
                "type" => "Literal",
                "options" => array(
                    "route" => "/walter",
                    'defaults' => array(
                        'renderer' => 'UpCloo\\Renderer\\Jsonp',
                        'controller' => 'Your\\Controller\\Name',
                        'action' => 'hello'
                    )
                ),
                'may_terminate' => true,
            )
        )
    )
);
```

Start with a controller (src/Your/Controller/Name.php)

```
<?php
namespace Your\Controller;

class Name
{
    public function hello()
    {
        return "world";
    }
}
```

Start your web service

```
php -S localhost:8080 -t web
```

Go to your page `-> localhost:8080/walter`

## Comparison between ZF2 and this micro framework

ZF2 is a fullstack, general purpose, framework and it can assolve a large
set of problems. The flexibility of ZF2 components allows any
developer to create a personal framework that assolve a particular scenario
that improve things with the drawback of loosing stuffs. For example this
framework lose the ModuleManager and a lot of other things that we don't need.
On the other hand we can get different benefits. A simple performance test on
the same problem resolved with ZF2 (JSON RESTful) and this framework generate
something like this:

```
Concurrency level: 5

                +-------+-----------+-----------+-------+-----------+-------+
                | #/s   | min (ms)  | max (ms)  | mean  | median    | sd    |
    +-----------+-------+-----------+-----------+-------+-----------+-------+
    + ZF2       | 39    | 33        | 146       | 126   | 126       | 4.9   |
    +-----------+-------+-----------+-----------+-------+-----------+-------+
    + micro     | 130   | 21        | 52        | 37    | 37        | 1.8   |
    +-----------+-------+-----------+-----------+-------+-----------+-------+
```

This report is generated using the internal php web server (as web server) and
the Apache "ab" tool.

As you can see, this micro framework response, in mean, in less than one order
of magnitude than ZF2 standard application with a JSON RESTful module installed

