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

use ExOrg\DataCoder\Coder\Datafile\EncodingStrategyInterface;
use ExOrg\DataCoder\File\File;
use ExOrg\DataCoder\Coder\Json\Data\Encoder as DataEncoder;

/**
 * Json Datafile Encoder.
 * Datafile encoder for JSON format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class Encoder implements EncodingStrategyInterface
{
    /**
     * Encode JSON data and write to the file.
     *
     * @param array $data
     * @param string $filePath
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function encodeFile(array $data, string $filePath): void
    {
        $file = new File($filePath);

        $dataEncoder = new DataEncoder();
        $fileData = $dataEncoder->encodeData($data);

        $file->setContent($fileData);
    }
}
