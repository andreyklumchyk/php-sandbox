<?php

namespace Chat;


/**
 * Represents a HTTP requests router that performs dispatching of
 * application pages.
 */
class Router
{
    /**
     * Contains all possible pages (and their properties) of application.
     *
     * @var array[]
     */
    protected $pages = [
        'index' => [],
        '404' => [],
    ];


    /**
     * Dispatches given page alias to exact page.
     *
     * If page does not exist then 404 page will be returned.
     *
     * @param string $page      Alias of page to be returned.
     *
     * @return array    Alias and properties of dispatched page.
     */
    public function dispatch(string $page): array
    {
        if (isset($this->pages[$page])) {
            return [$page, $this->pages[$page]];
        }
        return ['404', $this->pages['404']];
    }
}
