<?php

namespace Chat\Util;


/**
 * Functions for class names resolving by class aliases or class paths.
 */
trait ClassNameResolver
{
    /**
     * Returns class name for given class alias or path.
     * Example:
     *  "user/pre_posting.pdf" is converted to "User\PrePostingPdf".
     *
     * @param string $alias     Alias (or path) of class.
     *
     * @return string       Name of Class.
     */
    protected static function makeClassName(string $alias): string
    {
        if ($alias === '') {
            return '';
        }
        $alias = preg_replace(
            '/[^a-z_\/\.-]/i', '' , preg_replace(
            '/^@/', 'Sys_/', trim($alias, '/_.-')
        ));
        return implode('\\', array_map(
            __CLASS__.'::toCamelCase', explode('/', $alias)
        ));
    }

    /**
     * Converts given string from snake case to camel case.
     * Dots "." are processed as "_".
     * Example:
     *  "my_super_method" => "MySuperMethod"
     *  "my.super.method" => "MySuperMethod"
     *  "my-super-method" => "MySuperMethod"
     *
     * @param string $str   String to be converted.
     *
     * @return string   Converted string.
     */
    protected static function toCamelCase(string $str): string
    {
        if ($str === '') {
            return '';
        }
        $str[0] = strtoupper($str[0]);
        return preg_replace_callback('/[_\.-]([a-z])/i', function ($m) {
            return strtoupper($m[1]);
        }, $str);
    }
}
