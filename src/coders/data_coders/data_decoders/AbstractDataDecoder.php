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
 * AbstractDataDecoder.
 * Abstract class for Data Decoder
 * for concrete data format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
abstract class AbstractDataDecoder
{
    /**
     * Validate data.
     *
     * @param string $data
     * @throws \InvalidArgumentException
     */
    protected function validateData($data)
    {
        if (!is_string($data)) {
            throw new \InvalidArgumentException(
                'Data must be a string.'
            );
        }
    }
}
