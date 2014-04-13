<?php

namespace spec\Storage;

use League\Flysystem\Filesystem as FlySystem;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FlyFileSystemSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Storage\FlyFileSystem');
    }

    function it_should_save_data_to_filesystem(FlySystem $filesystem)
    {
        $data = 'contents';

        $filesystem->write('file.extension', $data)->shouldBeCalled();

        $this->write('file.extension', $data);
    }

    function let(FlySystem $filesystem)
    {
        $this->beConstructedWith($filesystem);
    }
}
