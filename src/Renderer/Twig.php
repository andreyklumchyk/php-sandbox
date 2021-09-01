<?php

namespace Chat\Renderer;

use \Chat\Page;
use \Chat\Renderer;


/**
 * Implements view renderer on top of Twig templates engine.
 */
class Twig implements Renderer
{
    /**
     * Absolute path to default directory which contains Twig templates cache.
     */
    const DEFAULT_CACHE_DIR = PROJECT_ROOT.'/.cache/twig';


    /**
     * Twig engine for rendering templates.
     *
     * @var \Twig\Environment
     */
    protected $Twig;


    /**
     * Creates new Twig view renderer.
     *
     * @param string $templatesPath  Absolute path to directory which contains
     *                               Twig templates.
     * @param bool   $autoReload     Whether to recompile templates if their
     *                               original source was changed or not.
     * @param string $cachePath      Absolute path to directory which contains
     *                               cache of Twig templates.
     */
    public function __construct(
        string $templatesPath, bool $autoReload = false,
        string $cachePath = self::DEFAULT_CACHE_DIR
    ) {
        $cachePath = rtrim($cachePath, '/');
        if (!is_dir($cachePath) && !mkdir($cachePath, 0755, true)) {
            throw new \RuntimeException(
                'Cannot create '.$cachePath.' directory for Twig cache'
            );
        }

        $this->Twig = new \Twig\Environment(
            new \Twig\Loader\FilesystemLoader(rtrim($templatesPath, '/').'/'), [
                'cache'       => $cachePath,
                'auto_reload' => $autoReload,
            ]
        );
    }

    /**
     * Renders specified page and prints it immediately.
     * Sets HTTP status response code accordingly to code in passed page.
     *
     * @param Page $page  Page to render.
     */
    public function renderPage(Page $page)
    {
        echo $this->renderHtml('pages/'.$page->alias, $page->toRender);
    }

    /**
     * Renders HTML template specified by its alias.
     *
     * @param string $alias     Alias of template to be rendered.
     * @param array $params     Parameters for template rendering.
     *
     * @return string   Rendered HTML template.
     */
    public function renderHtml(string $alias, array $params): string
    {
        return $this->Twig->load($alias.'.twig')->render($params);
    }
}
