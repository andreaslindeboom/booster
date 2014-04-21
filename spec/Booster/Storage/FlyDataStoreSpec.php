<?php

namespace spec\Booster\Storage;

use League\Flysystem\Filesystem as FlySystem;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FlyDataStoreSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Booster\Storage\FlyDataStore');
    }

    function it_should_request_data_from_filesystem(FlySystem $filesystem)
    {
        $filesystem->read('booster.json')->shouldBeCalled();

        $this->getByName('booster');
    }

    function let(FlySystem $filesystem)
    {
        $this->beConstructedWith($filesystem);
    }
}
