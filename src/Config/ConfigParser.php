<?php

namespace Booster\Config;

interface ConfigParser
{

    public function parse($data, $entityName);

}
