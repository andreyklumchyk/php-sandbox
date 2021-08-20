<?php

namespace Chat;


/**
 * Describes behaviour that each renderer of application view must implement.
 */
interface Renderer
{
    /**
     * Renders specified page and prints it immediately.
     *
     * @param Page $page
     */
    public function renderPage(Page $page);

    /**
     * Renders HTML template specified by its alias.
     *
     * @param string $alias     Alias of template to be rendered.
     * @param array $params     Parameters for template rendering.
     *
     * @return string   Rendered HTML template.
     */
    public function renderHtml(string $alias, array $params): string;
}
