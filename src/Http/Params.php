<?php

namespace Chat\Http;


/**
 * Represents a set for key-value pairs of parameters.
 */
class Params
{
    /**
     * Contains parameters represented by this set.
     *
     * @var array
     */
    protected $params;


    /**
     * Creates new parameters set from given array.
     *
     * @param array $params  Array of parameters to create set of.
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * Returns all parameters as key-value array.
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->params;
    }

    /**
     * Checks if specified parameter exists.
     *
     * @param string|int $key  Name of parameter.
     *
     * @return bool     Yes or no.
     */
    public function exists($key): bool
    {
        return isset($this->params[$key]);
    }

    /**
     * Returns space-truncated string representation of required parameter.
     *
     * @param string|int $key  Name of parameter.
     *
     * @return string   Space-truncated string representation of parameter.
     */
    public function String($key): string
    {
        return trim(strval(($this->params[$key])));
    }

    /**
     * Returns integer representation of required parameter.
     *
     * @param string|int $key  Name of parameter.
     *
     * @return int      Integer representation of parameter.
     */
    public function Int($key): int
    {
        return intval($this->params[$key]);
    }

    /**
     * Returns boolean representation of required parameter.
     *
     * @param string|int $key  Name of parameter.
     *
     * @return bool      Boolean representation of parameter.
     */
    public function Bool($key): bool
    {
        return (bool)$this->params[$key];
    }

    /**
     * Returns array representation of required parameter.
     *
     * @param string|int $key  Name of parameter.
     *
     * @return array      Array representation of parameter.
     */
    public function Arr($key): array
    {
        return (array)$this->params[$key];
    }
}
