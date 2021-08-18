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
 * JsonDatafileDecoder.
 * Datafile decoder for JSON format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright 2015-2021 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class JsonDatafileDecoder
{
    /**
     * Decode file content.
     *
     * @param string $filePath
     * @return array
     * @throws \InvalidArgumentException
     */
    public function decodeFile($filePath)
    {
        $file = new File($filePath);

        $fileData = $file->getContent();

        $dataDecoder = new JsonDataDecoder();
        $result = $dataDecoder->decodeData($fileData);

        return $result;
    }
}
