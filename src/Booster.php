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
use Symfony\Component\Console\Output\OutputInterface;

class Booster {

    private $output;

    function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    public function generateAll($entityName){
        $configurations = $this->generateAllConfigurations($entityName);

        foreach ($configurations as $configuration) {
            $generator = new Generator($configuration, new MustacheRenderer(new Mustache_Engine()), new FlyFileSystem(new Filesystem(new LocalAdapter('.'))));
            try {
                $generator->run();
                $this->output->writeln($configuration->getTargetPath() . " written!");
            } catch (\Exception $e) {
                $this->output->writeln("Something went wrong generating " . $configuration->getTargetPath());
            }
        }
    }

    public function generateAllConfigurations($entityName)
    {
        $configDataStore = new FlyDataStore(new Filesystem(new LocalAdapter('.')));

        $loader = new ConfigLoader($configDataStore);
        $parser = new JsonConfigParser(new DoctrineEntityInflector(), new MustacheRenderer(new Mustache_Engine()));

        return $parser->parse($loader->loadConfig(), $entityName);
    }
}