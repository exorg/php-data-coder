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
 * JsonDatafileEncoder.
 * Encodes JSON data and saves to file.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class JsonDatafileEncoder
{
    /**
     * Encoded file.
     *
     * @var File
     */
    protected $file;

    /**
     * Encode data and write to file.
     *
     * @param array $data
     * @param string $filePath
     */
    public function encodeFile($data, $filePath)
    {
        $this->file = new File($filePath);

        $dataEncoder = new JsonDataEncoder();
        $fileData = $dataEncoder->encodeData($data);

        $this->file->setContent($fileData);
    }
}
