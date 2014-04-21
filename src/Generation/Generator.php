<?php

namespace Booster\Generation;

use Booster\Config\TemplateConfiguration;
use Booster\Rendering\Renderer;
use Booster\Storage\FileSystem;

class Generator
{

    /**
     * @var TemplateConfiguration
     */
    private $templateConfiguration;
    /**
     * @var Renderer
     */
    private $renderer;
    /**
     * @var FileSystem
     */
    private $fileSystem;

    public function __construct(TemplateConfiguration $templateConfiguration, Renderer $renderer, FileSystem $fileSystem)
    {
        $this->templateConfiguration = $templateConfiguration;
        $this->renderer = $renderer;
        $this->fileSystem = $fileSystem;
    }

    public function run()
    {
        $renderedTemplate = $this->renderer->renderFromFile(
            $this->templateConfiguration->getTemplatePath(),
            $this->templateConfiguration->inflections
        );
        
        $this->fileSystem->write(
            $this->templateConfiguration->getTargetPath(),
            $renderedTemplate
        );
    }
}
