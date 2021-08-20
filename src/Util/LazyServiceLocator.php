<?php

namespace Chat\Util;


/**
 * Implements an IoC-container that provides access to objects by aliases.
 */
class LazyServiceLocator
{
    /**
     * Contains shared instances of IoC-container.
     * Instances that are bound directly (with no "lazy" evaluation)
     * are considered as shared too.
     *
     * @var mixed[]
     */
    protected $instances = [];

    /**
     * Represents an registry of constructor-functions of IoC-container.
     * Constructor-function is a function that returns
     * required object (or value).
     * These functions is used to create required objects "lazy" (only when
     * they are required).
     *
     * @var array
     */
    protected $aliases = [];


    /**
     * Returns object (or value) that is associated with given alias.
     *
     * @param string $alias  Alias that is associated with required object.
     *
     * @throws \InvalidArgumentException  If nothing is associated
     *                                    with given alias.
     *
     * @return mixed    Associated object (or value).
     */
    public function make(string $alias)
    {
        if (isset($this->instances[$alias])) {
            return $this->instances[$alias];
        }

        if (!isset($this->aliases[$alias])) {
            throw new \InvalidArgumentException(
                sprintf('Alias "%s" was not bound.', $alias)
            );
        }

        $instance = $this->aliases[$alias]['init']();
        if (!empty($this->aliases[$alias]['shared'])) {
            $this->instances[$alias] = $instance;
        }

        return $instance;
    }

    /**
     * Checks if exists any evaluated instance for given alias.
     *
     * @param string $alias     Alias to be checked.
     *
     * @return bool     Yes or no.
     */
    public function existsInstance(string $alias): bool
    {
        return isset($this->instances[$alias]);
    }

    /**
     * Associates given object (or any value) with given alias.
     *
     * @param string $alias    Alias that should be associated.
     * @param mixed $instance  Value that should be associated.
     */
    public function bindInstance(string $alias, $instance)
    {
        $this->erase($alias);
        $this->instances[$alias] = $instance;
    }

    /**
     * Associates given alias with given constructor-function
     * (function that will be used to create objects under this alias).
     *
     * @param string $alias   Alias to associate created objects with.
     * @param callable $init  Function that constructs and returns required
     *                        objects.
     * @param bool $shared    If true then once created object will be reused
     *                        every time it is requested
     *                        instead of creating new objects.
     */
    public function bindLazy(
        string $alias, callable $init, bool $shared = false
    ) {
        $this->erase($alias);
        $this->aliases[$alias] = ['init' => $init, 'shared' => $shared];
    }

    /**
     * Performs shared binding for given mapping '$alias => callable $init'
     * of constructor-functions (functions that will be used
     * to create objects under specified alias).
     *
     * @param callable[] $map   Mapping from alias to constructor-function.
     * @param string $prefix    Prefix to be added to each passed alias.
     */
    public function bindLazySingletons(array $map, string $prefix = '')
    {
        foreach ($map as $alias => $init) {
            $this->bindLazy($prefix.$alias, $init, true);
        }
    }

    /**
     * Removes given alias and any instances associated with it from
     * IoC-container.
     *
     * @param string $alias   Alias to be removed.
     */
    public function erase(string $alias)
    {
        unset($this->aliases[$alias], $this->instances[$alias]);
    }
}
