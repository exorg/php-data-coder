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
 * DataFormatConfigurableTrait.
 * Allows to use data format property.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
trait DataFormatConfigurableTrait
{
    /**
     * Data format.
     *
     * @var string
     */
    protected $dataFormat;

    /**
     * Set format of the processed data.
     *
     * @param string $dataFormat
     * @throws \InvalidArgumentException
     */
    public function setDataFormat($dataFormat)
    {
        $this->validateDataFormat($dataFormat);
        $this->dataFormat = $dataFormat;
    }

    /**
     * Validate data format.
     *
     * @param string $dataFormat
     * @throws \InvalidArgumentException
     */
    protected function validateDataFormat($dataFormat)
    {
        if (!is_string($dataFormat)) {
            throw new \InvalidArgumentException(
                'Data format cannot be empty.'
            );
        } elseif (empty($dataFormat)) {
            throw new \InvalidArgumentException(
                'Data format cannot be empty.'
            );
        }
    }
}
