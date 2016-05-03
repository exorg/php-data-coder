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
 * YamlDatafileDecoder.
 * Decodes YAML data file content.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class YamlDatafileDecoder
{
    /**
     * Decoded file.
     *
     * @var File
     */
    protected $file;

    /**
     * Decode file content.
     *
     * @param string $filePath
     * @return array
     */
    public function decodeFile($filePath)
    {
        $this->file = new File($filePath);

        $fileData = $this->file->getContent();

        $dataDecoder = new YamlDataDecoder();
        $result = $dataDecoder->decodeData($fileData);

        return $result;
    }
}
