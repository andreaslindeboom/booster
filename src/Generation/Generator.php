<?php

namespace Generation;

use Config\TemplateConfiguration;
use Rendering\Renderer;
use Storage\FileSystem;

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
            $this->templateConfiguration->templateFile,
            $this->templateConfiguration->inflections
        );

        $this->fileSystem->write(
            $this->templateConfiguration->getTargetPath(),
            $renderedTemplate
        );
    }
}
