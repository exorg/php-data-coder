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
 * FormatDataDecoder.
 * Dummy data decoder for testing purposes only.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright 2015-2021 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class FormatDataDecoder
{
    /**
     * Simulate data decodind
     * and return expected result.
     *
     * @param string $data
     * @return string
     */
    public function decodeData($data)
    {
        return array("<FORMAT DECODED DATA>"
            . $data
            . "</FORMAT DECODED DATA>");
    }
}
