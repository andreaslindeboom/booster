<?php
 /**
 * Part of Booster.
 *
 * @author     Andreas Lindeboom
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright  2014 Andreas Lindeboom
 * @link       http://github.com/andreaslindeboom
 */

namespace Booster\Console;

use Booster\Booster;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateAllCommand extends Command {

    protected function configure() {
        $this->setName('generate-all')
             ->setDescription('Generate all files for the given entity')
             ->addArgument(
                '[entity name]',
                InputArgument::REQUIRED,
                'The entity name to use in file generation.'
             );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $booster = new Booster($output);
        $entityName = $input->getArgument('[entity name]');
        $booster->generateAll($entityName);
    }
} 