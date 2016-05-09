<?php

/*
 * This file is part of the DataCoder package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Exorg\DataCoder;

/**
 * DatafileDecoder.
 * Allows to decode data file
 * accordingly the data format set directly
 * or defined by file extension.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DatafileDecoder
{
    use DataFormatConfigurableTrait;
    use DataFormatEstablishableTrait;
    use CoderBuildingTrait;

    /**
     * Datafile.
     *
     * @var File
     */
    protected $file;

    /**
     * Decode file content.
     *
     * @param string $filePath
     * @return array
     * @throws \InvalidArgumentException
     */
    public function decodeFile($filePath)
    {
        $this->file = new File($filePath);

        $this->establishDataFormat();
        $fileData = $this->file->getContent();

        $dataDecoder = $this->buildCoder();
        $result = $dataDecoder->decodeData($fileData);

        return $result;
    }
}
