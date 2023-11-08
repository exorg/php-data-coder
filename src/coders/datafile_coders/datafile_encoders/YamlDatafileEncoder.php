<?php

/*
 * This file is part of the DataCoder package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ExOrg\DataCoder;

use ExOrg\DataCoder\File\File;

/**
 * YamlDatafileEncoder.
 * Datafile encoder for YAML format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class YamlDatafileEncoder
{
    /**
     * Encode YAML data and write to the file.
     *
     * @param array $data
     * @param string $filePath
     * @throws \InvalidArgumentException
     */
    public function encodeFile($data, $filePath)
    {
        $file = new File($filePath);

        $dataEncoder = new YamlDataEncoder();
        $fileData = $dataEncoder->encodeData($data);

        $file->setContent($fileData);
    }
}
