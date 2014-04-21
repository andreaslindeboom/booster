<?php

namespace Booster\Inflection;

use Doctrine\Common\Inflector\Inflector;

class DoctrineEntityInflector implements EntityInflector
{

    public function generateInflections($name)
    {
        $baseSingularInflection = Inflector::classify($name);
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
}
