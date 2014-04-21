<?php
 /**
 * Part of Booster.
 *
 * @author     Andreas Lindeboom
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright  2014 Andreas Lindeboom
 * @link       http://github.com/andreaslindeboom
 */

namespace Booster\Storage;

use League\Flysystem\Filesystem as FlySystem;

class FlyFileSystem implements FileSystem {

    /**
     * @var FlySystem
     */
    private $flySystem;

    public function __construct(FlySystem $flySystem)
    {
        $this->flySystem = $flySystem;
    }

    public function write($filePath, $data)
    {
        $this->flySystem->write($filePath, $data);
    }
}
