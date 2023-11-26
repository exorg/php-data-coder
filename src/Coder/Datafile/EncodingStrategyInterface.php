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
 * Datafile Encoding Strategy Interface.
 * Defines interface of particular data file encoding strategy.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
interface EncodingStrategyInterface
{
    /**
     * Encode data and write to the file.
     *
     * @param array $data
     * @param string $filePath
     *
     * @return void
     */
    public function encodeFile(array $data, string $filePath): void;
}
