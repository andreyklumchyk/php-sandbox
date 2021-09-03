<?php

namespace Chat\Http;

use \Chat\Util\ArrayHelper;


/**
 * HTTP request to application.
 */
class Request
{
    /**
     * Host that HTTP request was made to.
     *
     * @var string
     */
    public $host = '';

    /**
     * Alias of page that was requested.
     *
     * @var string
     */
    public $page = '';

    /**
     * Contains GET parameters of HTTP request.
     *
     * @var Params
     */
    public $GET;

    /**
     * Contains POST parameters of HTTP request.
     *
     * @var Params
     */
    public $POST;


    /**
     * Creates new HTTP request with initialised empty parameters.
     */
    public function __construct()
    {
        $this->GET = new Params([]);
        $this->POST = new Params([]);
    }

    /**
     * Parses given HTTP request parameters.
     *
     * @param string $host      Host that HTTP request was made to.
     * @param string $uri       Full URI of HTTP request or just URI path.
     * @param array $query      Array of GET request parameters.
     * @param array $request    Array of POST request parameters.
     *
     * @return $this    Itself for chained calls.
     */
    public function parse(
        string $host = '', string $uri = '',
        array $query = [], array $request = []
    ): self {
        $this->host = $host;
        $this->page = $this->parseUriPath($uri);
        $this->GET = new Params($query);
        $this->POST = new Params($request);
        return $this;
    }

    /**
     * Parses HTTP request parameters from PHP super global variables.
     *
     * @return $this    Itself for chained calls.
     */
    public function parseSuperGlobal(): self
    {
        return $this->parse(
            $_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI'], $_GET, $_POST,
        );
    }

    /**
     * Performs parsing of URI path from full URI string.
     *
     * @param string $uri   Full URI string of HTTP request.
     *
     * @return string   URI path of HTTP request.
     */
    public static function parseUriPath(string $uri): string
    {
        $uriPath = trim(preg_replace('/^\/?~[^\/]*/', '',
            ArrayHelper::reset(explode('?', $uri))
        ), '/');
        return ($uriPath === '') ? 'index' : $uriPath;
    }
}
