<?php

/*
 * This file is part of the DataCoder package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ExOrg\DataCoder\Coder\Format\Data;

/**
 * Format Data Encoder.
 * Dummy data encoder for testing purposes only.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class Encoder
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
        $dataValues = array_values($data);
        $dataCore = array_shift($dataValues);

        return "<FORMAT ENCODED DATA>"
            . $dataCore
            . "</FORMAT ENCODED DATA>";
    }
}
