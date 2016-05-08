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
 * DatafileEncoder.
 * Allows to encode data file
 * accordingly the data format set directly
 * or defined by file extension.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DatafileEncoder
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
     * Encode data and write to the file.
     *
     * @param array $data
     * @param string $filePath
     */
    public function encodeFile($data, $filePath)
    {
        $this->file = new File($filePath);

        $this->establishDataFormat();

        $dataEncoder = $this->buildCoder();
        $fileData = $dataEncoder->encodeData($data);

        $this->file->setContent($fileData);
    }
}
