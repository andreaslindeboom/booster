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

    static function getSimpleConfig() {
        $inflections = [
            'StudlyCasedEntity' => 'ProspectiveCustomer',
            'StudlyCasedEntities' => 'ProspectiveCustomers',
            'camelCasedEntity' => 'prospectiveCustomer',
            'camelCasedEntities' => 'prospectiveCustomers',
            'snake_cased_entity' => 'prospective_customer',
            'snake_cased_entities' => 'prospective_customers',
        ];

        $singleConfig = new TemplateConfiguration(
            'service.mustache',
            'ProspectiveCustomerService.php',
            $inflections
        );
        $singleConfig->setTargetDirectory('app/' . 'ProspectiveCustomers');

        return [$singleConfig];
    }

}