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
 * DatafileDecoder.
 * Decode data file content
 * according to given format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DatafileDecoder
{
    use DataFormatConfigurableTrait;
    use CoderBuildingTrait;

    /**
     * Decoded file.
     *
     * @var File
     */
    protected $file;

    /**
     * Decode file content according to file type.
     *
     * @param string $filePath
     * @return array
     */
    public function decodeFile($filePath)
    {
        $this->file = new File($filePath);

        $this->establishDataFormat();
        $fileData = $this->file->getContent();

        $dataDecoder = $this->buildCoder();
        $result = $dataDecoder->decodeData($fileData);

        return $result;
    }

    /**
     * Establish the dataFormat
     * if not set directly.
     */
    private function establishDataFormat()
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
