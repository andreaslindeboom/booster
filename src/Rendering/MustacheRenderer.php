<?php

namespace Rendering;

class MustacheRenderer implements Renderer
{

    /**
     * @var \Mustache_Engine
     */
    private $engine;

    /**
     * @var \Mustache_Loader_FilesystemLoader
     */
    private $loader;

    function __construct(\Mustache_Engine $engine, \Mustache_Loader $loader = null)
    {
        $this->engine = $engine;

        if ($loader === null) {
            $loader = new \Mustache_Loader_FilesystemLoader(
                __DIR__ . '/../../'
            );
        }
        
        $this->loader = $loader;
    }

    public function renderFromFile($templatePath, $data = null)
    {
        $defaultLoader = $this->engine->getLoader();
        $this->engine->setLoader($this->loader);
        $output = $this->engine->render($templatePath, $data);
        $this->engine->setLoader($defaultLoader);

        return $output;
    }

    public function render($template, $data)
    {
        return $this->engine->render($template, $data);
    }
}
