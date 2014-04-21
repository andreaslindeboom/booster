<?php

namespace spec\Booster\Config;

use Booster\Inflection\EntityInflector;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Booster\Rendering\Renderer;
use spec\Booster\Data\ConfigSpecData;

class JsonConfigParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Booster\Config\ConfigParser');
    }

    function it_should_parse_json_to_a_template_configuration_object()
    {
        $jsonConfig = ConfigSpecData::getSimpleJson();
        $templateConfigurations = ConfigSpecData::getSimpleConfigCollection();
        $this->parse($jsonConfig, 'prospective customer')
            ->shouldBeLike($templateConfigurations);
    }

    function it_should_get_template_directory_from_config()
    {
        $jsonConfig = ConfigSpecData::getJsonWithTemplateDir();
        $templateConfigurations = ConfigSpecData::getConfigCollectionWithTemplateDir();
        $this->parse($jsonConfig, 'prospective customer')
            ->shouldBeLike($templateConfigurations);
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
}
