<?php

/*
 * This file is part of the DataCoder package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ExOrg\DataCoder\Coder\Format1\Data;

/**
 * Dummy data decoder for testing purposes only.
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
     * Simulates data decodind
     * and return expected result.
     *
     * @param string $data
     * @return array
     */
    public function decodeData($data)
    {
        return ["<FORMAT 1 DECODED DATA/>"];
    }
}
