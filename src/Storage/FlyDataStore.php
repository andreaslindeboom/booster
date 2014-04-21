<?php

namespace Booster\Storage;

use League\Flysystem\Filesystem as FlySystem;

class FlyDataStore implements DataStore
{

    /**
     * @var Filesystem
     */
    private $filesystem;
    private $extension = 'json';

    function __construct(FlySystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function getByName($name)
    {
        $filename = "$name.$this->extension";

        return $this->filesystem->read($filename);
    }
}
