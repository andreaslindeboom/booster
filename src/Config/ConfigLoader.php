<?php

namespace Booster\Config;

use Booster\Storage\DataStore;

class ConfigLoader
{

    /**
     * @var DataStore
     */
    protected $dataStore;

    function __construct(DataStore $dataStore)
    {
        $this->dataStore = $dataStore;
    }

    public function loadConfig()
    {
        return $this->dataStore->getByName('booster');
    }

}
