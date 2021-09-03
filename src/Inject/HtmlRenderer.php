<?php

namespace Chat\Inject;

use \Chat\Injector;
use \Chat\Renderer;


/**
 * Provides class field that contains instance of HTML renderer
 * and can retrieve it from IoC-container.
 */
trait HtmlRenderer
{
    /**
     * Injected instance of HTML renderer.
     *
     * @var Renderer
     */
    protected $HtmlRenderer;


    /**
     * Retrieves instance of HTML renderer from IoC-container
     * if it is not set yet.
     *
     * @return Renderer  Initialized instance of HTML renderer.
     */
    protected function initHtmlRenderer(): Renderer
    {
        if (!isset($this->HtmlRenderer)) {
            $this->HtmlRenderer = Injector::make('HtmlRenderer');
        }
        return $this->HtmlRenderer;
    }
}
