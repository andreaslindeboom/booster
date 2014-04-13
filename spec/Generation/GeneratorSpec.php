<?php

namespace spec\Generation;

use Config\TemplateConfiguration;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Rendering\Renderer;
use spec\Data\ConfigSpecData;
use Storage\FileSystem;

class GeneratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Generation\Generator');
    }

    function it_should_invoke_the_renderer_to_render_a_template(Renderer $renderer)
    {
        $templateConfiguration = ConfigSpecData::getSimpleConfig();

        $renderer->renderFromFile($templateConfiguration->templateFile, $templateConfiguration->inflections)
            ->shouldBeCalled();

        $this->run();
    }

    function it_should_store_a_template_in_the_filesystem(FileSystem $fileSystem)
    {
        $data = 'contents';

        $templateConfiguration = ConfigSpecData::getSimpleConfig();

        $fileSystem->write($templateConfiguration->getTargetPath(), $data)
            ->shouldBeCalled();

        $this->run();
    }

    function let(Renderer $renderer, FileSystem $fileSystem)
    {
        $templateConfiguration = ConfigSpecData::getSimpleConfig();

        $renderer->renderFromFile($templateConfiguration->templateFile, $templateConfiguration->inflections)
            ->willReturn('contents');

        $this->beConstructedWith($templateConfiguration, $renderer, $fileSystem);
    }
}
