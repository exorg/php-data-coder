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
 * @copyright 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DatafileEncoder extends AbstractDatafileCoder
{
    use CoderBuildingTrait;

    /**
     * Encode data and write to the file.
     *
     * @param array $data
     * @param string $filePath
     * @throws \InvalidArgumentException
     */
    public function encodeFile($data, $filePath)
    {
        $this->file = new File($filePath);

        $this->completeDataFormat();
        $dataEncoder = $this->buildCoder();

        $fileData = $dataEncoder->encodeData($data);
        $this->file->setContent($fileData);
    }
}
