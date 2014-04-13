<?php

namespace spec\Inflection;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\Data\ConfigSpecData;

class DoctrineEntityInflectorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Inflection\DoctrineEntityInflector');
    }

    function it_should_inflect_a_space_separated_entity()
    {
        $entity = "prospective customer";

        $this->generateInflections($entity)
            ->shouldReturn(ConfigSpecData::getSimpleInflections());
    }

    function it_should_inflect_a_camel_cased_entity()
    {
        $entity = "prospectiveCustomer";

        $this->generateInflections($entity)
            ->shouldReturn(ConfigSpecData::getSimpleInflections());
    }

    function it_should_inflect_a_snake_cased_entity()
    {
        $entity = "prospective_customer";

        $this->generateInflections($entity)
            ->shouldReturn(ConfigSpecData::getSimpleInflections());
    }

    function it_should_inflect_a_studly_cased_entity()
    {
        $entity = "ProspectiveCustomer";

        $this->generateInflections($entity)
            ->shouldReturn(ConfigSpecData::getSimpleInflections());
    }
}
