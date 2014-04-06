<?php

namespace Config;

use Doctrine\Common\Inflector\Inflector;

class JsonConfigParser implements ConfigParser
{
    public function parse($data, $entityName)
    {
        $inflections = $this->generateInflections($entityName);
        $renderedData = $this->renderData($data, $inflections);
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
     * @param $entityName
     * @return array
     */
    public function generateInflections($entityName)
    {
        $baseSingularInflection = Inflector::classify($entityName);
        $baseMultipleInflection = Inflector::pluralize($baseSingularInflection);

        $inflections = [
            'StudlyCasedEntity' => $baseSingularInflection,
            'StudlyCasedEntities' => Inflector::pluralize($baseMultipleInflection),
            'camelCasedEntity' => Inflector::camelize($baseSingularInflection),
            'camelCasedEntities' => Inflector::camelize($baseMultipleInflection),
            'snake_cased_entity' => Inflector::tableize($baseSingularInflection),
            'snake_cased_entities' => Inflector::tableize($baseMultipleInflection),
        ];
        return $inflections;
    }

    /**
     * @param $data
     * @param $inflections
     * @return string
     */
    public function renderData($data, $inflections)
    {
        $mustache = new \Mustache_Engine();
        $renderedData = $mustache->render($data, $inflections);

        return $renderedData;
    }

    /**
     * @param $parsedData
     * @param $inflections
     * @return array
     */
    public function createTemplateConfigurations($parsedData, $inflections)
    {
        $templateConfigurations = array();

        foreach ($parsedData->templates as $template) {
            $templateConfiguration = new TemplateConfiguration(
                $template->templateFile,
                $template->targetFile,
                $inflections
            );
            $templateConfiguration->setTargetDirectory($template->targetDirectory);

            $templateConfigurations[] = $templateConfiguration;
        }

        return $templateConfigurations;
    }
}
