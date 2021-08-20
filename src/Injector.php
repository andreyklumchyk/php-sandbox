<?php

namespace Chat;


/**
 * Provides global interface to IoC-container.
 *
 * @method static mixed make(string $alias)  Returns object (or value) that is
 *                                           associated with given alias.
 * @method static bool existsInstance(string $alias)  Checks if exists any
 *                                                    evaluated instance
 *                                                    for given alias.
 * @method static bindInstance(string $alias, mixed $instance)  Associates given
 *                                                              object (or any
 *                                                              value) with
 *                                                              given alias.
 */
class Injector
{
    use Util\Facade;
}
