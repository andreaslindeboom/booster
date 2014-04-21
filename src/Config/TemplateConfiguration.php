<?php
/**
 * Part of Booster.
 *
 * @author     Andreas Lindeboom
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright  2014 Andreas Lindeboom
 * @link       http://github.com/andreaslindeboom
 */

namespace Booster\Config;

/**
 * Class TemplateConfiguration
 * @package Config
 * @property string targetFile
 * @property string targetDirectory
 * @property string templateFile
 * @property string templateDirectory
 * @property string inflections
 */
class TemplateConfiguration
{

    private $properties;

    function __construct($templateFile, $targetFile, $inflections)
    {
        $this->properties['targetFile'] = $targetFile;
        $this->properties['templateFile'] = $templateFile;
        $this->properties['inflections'] = $inflections;
    }

    public function __get($propertyName)
    {
        if (! isset($this->properties[$propertyName])) {
            throw new \Exception("Undefined property $propertyName.");
        }

        return $this->properties[$propertyName];
    }

    public function setTargetDirectory($directory)
    {
        if (isset($this->properties['targetDirectory'])) {
            throw new \Exception('Target directory can not be set twice.');
        }

        $this->properties['targetDirectory'] = $this->ensureHasTrailingSlash($directory);
    }

    public function setTemplateDirectory($directory){
        if (isset($this->properties['templateDirectory'])) {
            throw new \Exception('Template directory can not be set twice.');
        }

        $this->properties['templateDirectory'] = $this->ensureHasTrailingSlash($directory);
    }

    public function getTargetPath()
    {
        if (! isset ($this->properties['targetDirectory'])) {
            return $this->targetFile;
        }

        return $this->targetDirectory . $this->targetFile;
    }

    public function getTemplatePath(){
        if (! isset ($this->properties['templateDirectory'])) {
            return $this->templateFile;
        }

        return $this->templateDirectory . $this->templateFile;
    }

    public function ensureHasTrailingSlash($subject){
        return preg_replace('{/$}', '', $subject) . '/';
    }

}