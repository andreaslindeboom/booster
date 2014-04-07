<?php

namespace spec\Inflection;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DoctrineInflectorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Inflection\DoctrineEntityInflector');
    }
}
