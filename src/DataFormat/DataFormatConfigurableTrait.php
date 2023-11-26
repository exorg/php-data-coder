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

namespace ExOrg\DataCoder\DataFormat;

/**
 * Data Format Configurable Trait.
 * Allows to use data format property.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
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
    protected string $dataFormat;

    /**
     * Set format of the processed data.
     *
     * @param string $dataFormat
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function setDataFormat(string $dataFormat): void
    {
        $this->validateDataFormat($dataFormat);
        $this->dataFormat = $dataFormat;
    }

    /**
     * Validate data format.
     *
     * @param string $dataFormat
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    protected function validateDataFormat(string $dataFormat): void
    {
        if (empty($dataFormat)) {
            throw new \InvalidArgumentException(
                'Data format cannot be empty.'
            );
        }
    }
}
