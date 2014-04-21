<?php

namespace spec\Booster\Rendering;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MustacheRendererSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Booster\Rendering\MustacheRenderer');
    }

    function it_should_load_template_from_file(\Mustache_Engine $engine)
    {
        $engine->getLoader()->willReturn(new \Mustache_Loader_StringLoader());
        $engine->render('foo', [])->shouldBeCalled();
        $engine->setLoader(Argument::any())->shouldBeCalledTimes(2);

        $this->renderFromFile('foo', []);
    }

    function it_should_render_template_from_string(\Mustache_Engine $engine)
    {
        $engine->render('{{Foo}}', ['Foo' => 'bar'])
            ->shouldBeCalled()
            ->willReturn('bar');

        $this->render('{{Foo}}', ['Foo' => 'bar'])
            ->shouldReturn('bar');
    }

    function let(\Mustache_Engine $engine)
    {
        $this->beConstructedWith($engine);
    }
}
