<?php

namespace spec\Config;

use Inflection\EntityInflector;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Rendering\Renderer;
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
        $templateConfigurations = ConfigSpecData::getSimpleConfigCollection();
        $this->parse($jsonConfig, 'prospective customer')
            ->shouldReturnArrayLike($templateConfigurations);
    }

    function it_should_get_template_directory_from_config()
    {
        $jsonConfig = ConfigSpecData::getJsonWithTemplateDir();
        $templateConfigurations = ConfigSpecData::getConfigCollectionWithTemplateDir();
        $this->parse($jsonConfig, 'prospective customer')
            ->shouldReturnArrayLike($templateConfigurations);
    }

    function let(EntityInflector $inflector, Renderer $renderer)
    {
        $inflector->generateInflections('prospective customer')
            ->willReturn(ConfigSpecData::getSimpleInflections());

        $renderer->render(ConfigSpecData::getSimpleJson(), ConfigSpecData::getSimpleInflections())
            ->willReturn(ConfigSpecData::getSimpleRenderedJson('ProspectiveCustomer'));

        $renderer->render(ConfigSpecData::getJsonWithTemplateDir(), ConfigSpecData::getSimpleInflections())
            ->willReturn(ConfigSpecData::getRenderedJsonWithTemplateDir('ProspectiveCustomer'));

        $this->beConstructedWith($inflector, $renderer);
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
