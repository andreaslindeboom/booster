<?php

namespace spec\Booster\Inflection;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\Booster\Data\ConfigSpecData;

class DoctrineEntityInflectorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Booster\Inflection\DoctrineEntityInflector');
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
