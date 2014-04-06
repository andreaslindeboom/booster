<?php

namespace spec\Config;

use Config\TemplateConfiguration;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\Data\ConfigSpecData;

class JsonConfigParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Config\ConfigParser');
    }

    function it_should_parse_json_to_a_template_configuration_object()
    {
        $jsonConfig = ConfigSpecData::getSimpleJson();
        $templateConfigurations = ConfigSpecData::getSimpleConfig();
        $this->parse($jsonConfig, 'prospective customer')
            ->shouldReturnArrayLike($templateConfigurations);
    }

    public function getMatchers()
    {
        return [
            'returnArrayLike' => function ($subject, $subjectTwo) {
                if (! (is_array($subject) && is_array($subjectTwo))) {
                    return false;
                }

                $isLike = true;

                foreach ($subject as $index => $element) {
                    if ($element != $subjectTwo[$index]) {
                        $isLike = false;
                    }
                }

                return $isLike;
            }
        ];
    }
}
