<?php

namespace Booster\Config;

use Booster\Rendering\Renderer;
use Booster\Inflection\EntityInflector;

class JsonConfigParser implements ConfigParser
{

    /**
     * @var \Rendering\Renderer
     */
    private $renderer;

    /**
     * @var \Inflection\EntityInflector
     */
    private $inflector;

    function __construct(EntityInflector $inflector, Renderer $renderer)
    {
        $this->inflector = $inflector;
        $this->renderer = $renderer;
    }

    public function parse($data, $entityName)
    {
        $inflections = $this->inflector->generateInflections($entityName);
        $renderedData = $this->renderer->render($data, $inflections);
        $parsedData = json_decode($renderedData);

        if (! isset($parsedData->templates)) {
            throw new \Exception('No template data found in configuration.');
        }

        $templateConfigurations = $this->createTemplateConfigurations(
            $parsedData,
            $inflections
        );
        
        return $templateConfigurations;
    }

    /**
     * @param $parsedData
     * @param $inflections
     * @return TemplateConfiguration[]
     */
    public function createTemplateConfigurations($parsedData, $inflections)
    {
        $templateConfigurations = array();

        foreach ($parsedData->templates as $template) {

            $templateConfiguration = $this->createTemplateConfiguration(
                $parsedData,
                $inflections,
                $template
            );

            $templateConfigurations[] = $templateConfiguration;

        }

        return $templateConfigurations;
    }

    /**
     * @param $parsedData
     * @param $inflections
     * @param $template
     * @return TemplateConfiguration
     */
    public function createTemplateConfiguration($parsedData, $inflections, $template)
    {
        $templateConfiguration = new TemplateConfiguration(
            $template->templateFile,
            $template->targetFile,
            $inflections
        );

        if (isset($parsedData->templateDirectory)) {
            $templateConfiguration->setTemplateDirectory(
                $parsedData->templateDirectory
            );
        }

        $templateConfiguration->setTargetDirectory(
            $template->targetDirectory
        );

        return $templateConfiguration;
    }
}
