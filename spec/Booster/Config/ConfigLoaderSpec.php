<?php

namespace spec\Booster\Config;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Booster\Storage\DataStore;

class ConfigLoaderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Booster\Config\ConfigLoader');
    }

    function it_loads_the_configuration_using_the_datastore(DataStore $store)
    {
        $store->getByName('booster')->shouldBeCalled();

        $this->loadConfig();
    }

    function let(DataStore $store)
    {
        $this->beConstructedWith($store);
    }
}
