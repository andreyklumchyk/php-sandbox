<?php

/**
 * Initial memory limit is increased as far as Kahlan requires more memory
 * for performing JIT operations over large libraries like mPDF.
 */
ini_set('memory_limit', '512M');

# TODO: check and fix
/**
 * Disables debug mode by default to avoid debug-behaviour in tests
 * when it's not expected.
 */
\Chat\Conf::$isDebugMode = false;

/**
 * Registering custom handy matchers.
 */
\Kahlan\Matcher::register('toBeOneOf', '\Chat\Matcher\ToBeOneOf');
