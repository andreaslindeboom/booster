<?php
/**
 * Part of Booster.
 *
 * @author     Andreas Lindeboom
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright  2014 Andreas Lindeboom
 * @link       http://github.com/andreaslindeboom
 */
namespace Booster\Inflection;

interface EntityInflector
{

    public function generateInflections($name);

}