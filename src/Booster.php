<?php
 /**
 * Part of Booster.
 *
 * @author     Andreas Lindeboom
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright  2014 Andreas Lindeboom
 * @link       http://github.com/andreaslindeboom
 */

namespace Booster;

use Booster\Storage\FlyDataStore;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local as LocalAdapter;
use Booster\Config\ConfigLoader;
use Booster\Config\JsonConfigParser;
use Booster\Generation\Generator;
use Booster\Inflection\DoctrineEntityInflector;
use Booster\Rendering\MustacheRenderer;
use Booster\Storage\FlyFileSystem;
use Mustache_Engine;

class Booster {

    private $configs;

    function __construct()
    {
        $configDataStore = new FlyDataStore(new Filesystem(new LocalAdapter('.')));
        $loader = new ConfigLoader($configDataStore);
        $rawConfig = $loader->loadConfig();
        $parser = new JsonConfigParser(new DoctrineEntityInflector(), new MustacheRenderer(new Mustache_Engine()));
        $this->configs = $parser->parse($rawConfig, 'member');
    }

    public function run(){


        foreach ($this->configs as $config) {
            $generator = new Generator($config, new MustacheRenderer(new Mustache_Engine()), new FlyFileSystem(new Filesystem(new LocalAdapter('.'))));
            $generator->run();
        }
    }
}