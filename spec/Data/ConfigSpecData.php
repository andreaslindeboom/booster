<?php

namespace spec\Data;

use Config\TemplateConfiguration;

class ConfigSpecData
{
    static function getSimpleJson() {
    return <<<EOT
{
    "templates": [
        {
            "templateFile": "service.mustache",
            "targetDirectory": "app/{{StudlyCasedEntities}}",
            "targetFile": "{{StudlyCasedEntity}}Service.php"
        }
    ]
}
EOT;
    }

    static function getJsonWithTemplateDir() {
        return <<<EOT
{
    "templateDirectory": "templates",
    "templates": [
        {
            "templateFile": "service.mustache",
            "targetDirectory": "app/{{StudlyCasedEntities}}",
            "targetFile": "{{StudlyCasedEntity}}Service.php"
        }
    ]
}
    }
EOT;
    }

    static function getSimpleRenderedJson($studlyCasedEntity) {
        return <<<EOT
{
    "templates": [
        {
            "templateFile": "service.mustache",
            "targetDirectory": "app/{$studlyCasedEntity}s",
            "targetFile": "{$studlyCasedEntity}Service.php"
        }
    ]
}
EOT;
    }

    static function getRenderedJsonWithTemplateDir($studlyCasedEntity) {
        return <<<EOT
{
    "templates": [
        {
            "templateFile": "templates/service.mustache",
            "targetDirectory": "app/{$studlyCasedEntity}s",
            "targetFile": "{$studlyCasedEntity}Service.php"
        }
    ]
}
EOT;
    }

    /**
     * @return TemplateConfiguration[]
     */
    static function getSimpleConfigCollection() {
        $singleConfig = self::getSimpleConfig();

        return [$singleConfig];
    }

    /**
     * @return TemplateConfiguration[]
     */
    static function getConfigCollectionWithTemplateDir() {
        $singleConfig = self::getConfigWithTemplateDir();

        return [$singleConfig];
    }

    /**
     * @return TemplateConfiguration
     */
    public static function getSimpleConfig()
    {
        $inflections = self::getSimpleInflections();

        $singleConfig = new TemplateConfiguration(
            'service.mustache',
            'ProspectiveCustomerService.php',
            $inflections
        );
        $singleConfig->setTargetDirectory('app/' . 'ProspectiveCustomers');

        return $singleConfig;
    }

    /**
     * @return TemplateConfiguration
     */
    public static function getConfigWithTemplateDir()
    {
        $inflections = self::getSimpleInflections();

        $singleConfig = new TemplateConfiguration(
            'templates/service.mustache',
            'ProspectiveCustomerService.php',
            $inflections
        );
        $singleConfig->setTargetDirectory('app/' . 'ProspectiveCustomers');

        return $singleConfig;
    }

    /**
     * @return array
     */
    public static function getSimpleInflections()
    {
        $inflections = [
            'StudlyCasedEntity' => 'ProspectiveCustomer',
            'StudlyCasedEntities' => 'ProspectiveCustomers',
            'camelCasedEntity' => 'prospectiveCustomer',
            'camelCasedEntities' => 'prospectiveCustomers',
            'snake_cased_entity' => 'prospective_customer',
            'snake_cased_entities' => 'prospective_customers',
        ];

        return $inflections;
    }
}
