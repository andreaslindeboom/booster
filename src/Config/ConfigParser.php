<?php

namespace Config;

interface ConfigParser
{

    public function parse($data, $entityName);

}
