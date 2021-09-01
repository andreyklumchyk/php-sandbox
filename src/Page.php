<?php

namespace Chat;

use \Chat\Http\Request;


/**
 * Describes a site page of Chat application.
 */
class Page
{
    use Util\ClassNameResolver;


    /**
     * Unique alias of page that identifies it.
     *
     * @var string
     */
    public $alias;

    /**
     * Parameters that are required for page rendering.
     *
     * @var array
     */
    public $toRender = [];


    /**
     * Concrete router instance which dispatches pages by its aliases.
     *
     * @var Router
     */
    public static $Router;


    /**
     * Creates new site page of application with given parameters.
     *
     * @param string $alias  Alias of page.
     * @param array $props   Properties of page as array.
     */
    public function __construct(string $alias, array $props = [])
    {
        $this->alias = $alias;
    }

    /**
     * Creates new site page of application dispatching its alias via router.
     *
     * @param string $alias     Alias of page to create.
     *
     * @return Page     Dispatched by router site page.
     */
    public static function create(string $alias): Page
    {
        if (!isset(self::$Router)) {
            self::$Router = new Router();
        }
        list($alias, $props) = self::$Router->dispatch($alias);
        return new self($alias, $props);
    }

    /**
     * Processes page of Chat application site.
     *
     * @param Request $req       HTTP request to site page.
     *
     * @return Page  Result page of specified page processing with all required
     *               parameters to be rendered.
     */
    public function process(Request $req): Page
    {
        $toReturnNow = $this->runScenario($req);
        if ($toReturnNow !== null) {
            return $toReturnNow;
        }
        return $this;
    }

    /**
     * Lookups for scenario of site page, runs this scenario if exists,
     * and processes its results.
     *
     * @param Request $req    HTTP request to site page.
     *
     * @return null|Page  May return already processed site page which must be
     *                    returned to user instead of current.
     */
    public function runScenario(Request $req): ?Page
    {
        $scenarioName = '\Chat\Scenario\\'.self::makeClassName($this->alias);
        if (!class_exists($scenarioName)) {
            return null;
        }
        /** @var Scenario $scenario */
        $scenario = new $scenarioName();
        $result = $scenario->run($req);

        if (isset($result['toRender'])) {
            $this->toRender = array_merge($this->toRender, $result['toRender']);
        }
        return $this;
    }
}
