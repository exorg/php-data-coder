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

namespace ExOrg\DataCoder\Coder\Datafile;

use ExOrg\DataCoder\CoderBuilder\CoderBuildingTrait;
use ExOrg\DataCoder\File\File;

/**
 * Datafile Decoder.
 * Allows to decode data file
 * accordingly the data format set directly
 * or defined by file extension.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class Decoder extends AbstractCoder implements DecodingStrategyInterface
{
    use CoderBuildingTrait;

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
        $this->file = new File($filePath);

        $this->completeDataFormat();
        $dataDecoder = $this->buildCoder();

        $fileData = $this->file->getContent();
        $result = $dataDecoder->decodeData($fileData);

        return $result;
    }
}
