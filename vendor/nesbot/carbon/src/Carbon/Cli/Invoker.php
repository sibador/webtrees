<?php

namespace Carbon\Cli;

class Invoker
{
    const CLI_CLASS_NAME = 'Carbon\\Cli';

    protected function runWithCli(string $className, array $parameters): bool
    {
        $cli = new $className();

        return $cli(...$parameters);
    }

    public function __invoke(...$parameters): bool
    {
        if (class_exists(self::CLI_CLASS_NAME)) {
            return $this->runWithCli(self::CLI_CLASS_NAME, $parameters);
        }

<<<<<<< HEAD
        shell_exec('composer require carbon-cli/carbon-cli --no-interaction');
=======
        $function = (($parameters[1] ?? '') === 'install' ? ($parameters[2] ?? null) : null) ?: 'shell_exec';
        $function('composer require carbon-cli/carbon-cli --no-interaction');
>>>>>>> 56a34df1984fbc88561415294f7408501262a1ab

        echo 'Installation succeeded.';

        return true;
    }
}
