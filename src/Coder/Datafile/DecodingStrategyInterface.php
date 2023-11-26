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

/**
 * Datafile Decoding Strategy Interface.
 * Defines interface of particular data file decoding strategy.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
interface DecodingStrategyInterface
{
    /**
     * Decode file content.
     *
     * @param string $filePath
     *
     * @return array
     */
    public function decodeFile(string $filePath): array;
}
