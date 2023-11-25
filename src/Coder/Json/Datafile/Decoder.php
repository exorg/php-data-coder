<?php

declare(strict_types=1);

/*
 * This file is part of the DataCoder package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ExOrg\DataCoder\Coder\Json\Datafile;

use ExOrg\DataCoder\File\File;
use ExOrg\DataCoder\Coder\Json\Data\Decoder as DataDecoder;

/**
 * Json Datafile Decoder.
 * Datafile decoder for JSON format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class Decoder
{
    /**
     * Decode file content.
     *
     * @param string $filePath
     *
     * @return array
     *
     * @throws \InvalidArgumentException
     */
    public function decodeFile(string $filePath): array
    {
        $file = new File($filePath);

        $fileData = $file->getContent();

        $dataDecoder = new DataDecoder();
        $result = $dataDecoder->decodeData($fileData);

        return $result;
    }
}
