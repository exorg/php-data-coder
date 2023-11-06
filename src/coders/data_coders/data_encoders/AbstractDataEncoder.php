<?php

/*
 * This file is part of the DataCoder package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ExOrg\DataCoder;

/**
 * AbstractDataEncoder.
 * Abstract class for Data Encoder
 * for concrete data format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
abstract class AbstractDataEncoder
{
    /**
     * Validate data.
     *
     * @param string $data
     * @throws \InvalidArgumentException
     */
    protected function validateData($data)
    {
        if (!is_array($data)) {
            throw new \InvalidArgumentException(
                'Data must be an array.'
            );
        }
    }
}
