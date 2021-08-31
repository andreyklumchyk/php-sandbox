<?php

namespace Chat\Scenario;


use Chat\Conf;
use \Chat\Http\Request;
use \Chat\Inject;
use \Chat\Scenario;


/**
 * Implements scenarios of index page for authorized visitors.
 */
class Index implements Scenario
{
    use Inject\HtmlRenderer;


    /**
     * Runs scenario of index page.
     *
     * @param Request $req      HTTP request to index page.
     *
     * @return array    Result of index page scenario.
     */
    public function run(Request $req): array
    {
        var_dump($_ENV['CONF_MYSQL_HOST']);
        var_dump(getenv('CONF_MYSQL_HOST'));
        $crdnt = [
            'mysql:host='.Conf::$MySQL['host'].';'.
            'dbname='.Conf::$MySQL['name'],
            Conf::$MySQL['user'], Conf::$MySQL['pass'],
        ];
        $conn = new \PDO($crdnt[0], $crdnt[1], $crdnt[2], [
            // \PDO::MYSQL_ATTR_COMPRESS => true,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            // \PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ]);

        var_dump($conn);


        return ['toRender' => [
            'data' => 'Hello Chat !!!',
        ]];
    }
}
