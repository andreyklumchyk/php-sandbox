<?php

namespace Chat\Spec\Renderer;

use \Chat\Router;


describe('Renderer\Twig', function () {


    $this->realTemplatePath = PROJECT_ROOT.'/templates';


    describe('templates of HTML pages', function () {

        foreach (
            getProtectedPropertyValue(new Router(), 'pages') as $page => $opt
        ) {
            it('must implement template for "'.$page.'" HTML page',
                function () use ($page) {
                    expect(is_file(
                        $this->realTemplatePath.'/pages/'.$page.'.twig'
                    ))->toBe(true);
                }
            );

        }

    });


});
