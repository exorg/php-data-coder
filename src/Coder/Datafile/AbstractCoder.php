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

namespace ExOrg\DataCoder\Coder\Datafile;

use ExOrg\DataCoder\DataFormat\DataFormatConfigurableTrait;
use ExOrg\DataCoder\File\File;

/**
 * Abstract Datafile Coder.
 * Abstract class for DatafileCoders
 * with configurable data format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
abstract class AbstractCoder
{
    use DataFormatConfigurableTrait;

    /**
     * Datafile.
     *
     * @var File
     */
    protected File $file;

    /**
     * Establish and set the dataFormat
     * if not set directly.
     *
     * @throws \LogicException
     */
    protected function completeDataFormat(): void
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
