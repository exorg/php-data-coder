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
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
trait DataFormatConfigurableTrait
{
    /**
     * Decoded data format.
     *
     * @var string
     */
    private $dataFormat;

    /**
     * Set format of decoded data.
     *
     * @param string $dataFormat
     */
    public function setDataFormat($dataFormat)
    {
        $this->validateDataFormat($dataFormat);
        $this->dataFormat = $dataFormat;
    }

    /**
     * Validate data format.
     *
     * @param unknown $dataFormat
     * @throws DataFormatInvalidException
     */
    public function validateDataFormat($dataFormat)
    {
        $dataFormatIsValid = (!is_null($dataFormat))
            && (!empty($dataFormat));

        if (!$dataFormatIsValid) {
            throw new \InvalidArgumentException(
                'Data format '
                . $dataFormat
                . ' is invalid'
            );
        }
    }
}
