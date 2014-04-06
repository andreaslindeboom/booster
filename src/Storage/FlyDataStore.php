<?php

namespace Storage;

use League\Flysystem\Filesystem;

class FlyDataStore implements DataStore
{

    /**
     * @var Filesystem
     */
    private $filesystem;
    private $extension = 'json';

    function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function getByName($name)
    {
        $filename = "$name.$this->extension";

        return $this->filesystem->read($filename);
    }
}
