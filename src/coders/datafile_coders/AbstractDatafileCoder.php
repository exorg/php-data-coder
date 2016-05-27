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
 * AbstractDatafileCoder.
 * Abstract class for DatafileCoders
 * with configurable data format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
abstract class AbstractDatafileCoder
{
    use DataFormatConfigurableTrait;

    /**
     * Datafile.
     *
     * @var File
     */
    protected $file;

    /**
     * Establish and set the dataFormat
     * if not set directly.
     *
     * @throws \LogicException
     */
    protected function completeDataFormat()
    {
        $dataFormatIsSetDirectly = isset($this->dataFormat);
        $fileHasExtension = !empty($this->file->getExtension());

        if (!$dataFormatIsSetDirectly && $fileHasExtension) {
            $this->dataFormat = strtolower($this->file->getExtension());
        } elseif (!$dataFormatIsSetDirectly) {
            throw new \LogicException(
                'File has no extension and format has not been set directly. '
                . 'File format cannot be established.'
            );
        }
    }
}
