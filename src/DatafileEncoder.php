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
 * Decode data file content
 * according to given format.
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
     * Decoded file.
     *
     * @var File
     */
    protected $file;

    /**
     * Encode file content according to file type.
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
