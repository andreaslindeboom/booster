<?php
 /**
 * Part of Booster.
 *
 * @author     Andreas Lindeboom
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright  2014 Andreas Lindeboom
 * @link       http://github.com/andreaslindeboom/minion
 */


namespace Config;


class TemplateConfiguration {

    private $templateFile;
    private $targetFile;
    private $targetDirectory;
    private $inflections;

    function __construct($templateFile, $targetFile, $inflections)
    {
        $this->targetFile = $targetFile;
        $this->templateFile = $templateFile;
        $this->inflections = $inflections;
    }

    public function setTargetDirectory($directory)
    {
        if (isset($this->targetDirectory)) {
            throw new \Exception('Target directory can not be set twice.');
        }

        $this->targetDirectory = $directory;
    }



}