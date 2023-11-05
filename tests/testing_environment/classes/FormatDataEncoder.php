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
 * FormatDataEncoder.
 * Dummy data encoder for testing purposes only.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class FormatDataEncoder
{
    /**
     * Simulate data encoding
     * and return expected result.
     *
     * @param array $data
     * @return string
     */
    public function encodeData($data)
    {
        return "<FORMAT ENCODED DATA>"
            . array_shift(array_values($data))
            . "</FORMAT ENCODED DATA>";
    }
}
