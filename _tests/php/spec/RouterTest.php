<?php

namespace Chat\Spec;

use \Chat\Router;


describe('Router', function () {


    describe('new Router()', function () {

        it('has correctly defined pages mapping', function () {
            $pages = getProtectedPropertyValue(new Router(), 'pages');
            expect($pages)->toBeAn('array');
            foreach ($pages as $alias => $options) {
                expect($alias)->toMatch('/^[a-z0-9@\/\._-]+$/i');
                expect($options)->toBeAn('array');
            }
        });

    });


});
