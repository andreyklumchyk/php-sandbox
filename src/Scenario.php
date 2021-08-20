<?php

namespace Chat;

use \Chat\Http\Request;


/**
 * Describes behaviour of application page scenario.
 * Scenario is an entity which contains business logic actions of site page.
 */
interface Scenario
{
    /**
     * Runs business logic actions.
     *
     * @param Request $req          HTTP request to site page.
     *
     * @return array    Result of performed scenario business logic actions.
     */
    public function run(Request $req): array;
}
