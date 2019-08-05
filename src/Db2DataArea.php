<?php

namespace As400Utils;

use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use DataArea;

class Db2DataArea
{
    use XMLToolkitAwareTrait, LoggerAwareTrait;

    /**
     * @param XMLToolkit $xmlToolkit
     * @param LoggerInterface $logger
     */
    public function __construct(XMLToolkit $xmlToolkit, LoggerInterface $logger=null)
    {
        $this->setXmlToolkit($xmlToolkit);
        $logger = $logger ? $logger : $xmlToolkit->getLogger();
        $this->setLogger($logger);
    }

    protected $dataAreaName;
    protected $dataAreaLibrary = '*LIBL';
    protected $readOffset = 1;
    protected $readLength = '*ALL';
    protected $writeOffset = 0;
    protected $writeLength = '*ALL';

    public function read($readOffset = null, $writeLength = null)
    {
        return $this->readDataArea($this->getDataAreaName(), $this->getDataAreaLibrary(), $readOffset, $writeLength);
    }

    public function readDataArea($dataAreaName, $dataAreaLibrary = null, $readOffset = null, $readLength = null)
    {
        $readOffset = !is_null($readOffset) ? $readOffset : $this->getReadOffset();
        $readLength = !is_null($readLength) ? $readLength : $this->getReadLength();
        $dataAreaLibrary = !is_null($dataAreaLibrary) ? $dataAreaLibrary : $this->getDataAreaLibrary();

        $dataAreaObj = $this->getDataAreaInstance($dataAreaName, $dataAreaLibrary);

        $value = $dataAreaObj->readDataArea($readOffset, $readLength);
        return $value;
    }

    public function write($value, $writeOffset = null, $writeLength = null)
    {
        $this->writeDataArea($this->getDataAreaName(), $value, $this->getDataAreaLibrary(), $writeOffset, $writeLength);
    }

    public function writeDataArea($dataAreaName, $value, $dataAreaLibrary = null, $writeOffset = null, $writeLength = null)
    {
        $writeOffset = !is_null($writeOffset) ? $this->getWriteOffset() : $writeOffset;
        $writeLength = !is_null($writeLength) ? $writeLength : $this->getWriteLength();
        $dataAreaLibrary = !is_null($dataAreaLibrary) ? $dataAreaLibrary : $this->getDataAreaLibrary();

        $dataAreaObj = $this->getDataAreaInstance($dataAreaName, $dataAreaLibrary);
        $dataAreaObj->writeDataArea($value, $writeOffset, $writeLength);
    }

    public function getDataAreaInstance($dataAreaName, $dataAreaLibrary = '*LIBL')
    {
        $dataAreaObj = new DataArea($this->getXmlToolkit()->getToolkitServiceObj());
        $dataAreaObj->setDataAreaName($dataAreaName, $dataAreaLibrary);
        return $dataAreaObj;
    }

    /**
     * @return mixed
     */
    public function getDataAreaName()
    {
        return $this->dataAreaName;
    }

    /**
     * @param mixed $dataAreaName
     */
    public function setDataAreaName($dataAreaName)
    {
        $this->dataAreaName = $dataAreaName;
    }

    /**
     * @return mixed
     */
    public function getDataAreaLibrary()
    {
        return $this->dataAreaLibrary;
    }

    /**
     * @param mixed $dataAreaLibrary
     */
    public function setDataAreaLibrary($dataAreaLibrary)
    {
        $this->dataAreaLibrary = $dataAreaLibrary;
    }

    /**
     * @return string
     */
    public function getReadOffset()
    {
        return $this->readOffset;
    }

    /**
     * @param string $readOffset
     */
    public function setReadOffset($readOffset)
    {
        $this->readOffset = $readOffset;
    }

    /**
     * @return string
     */
    public function getReadLength()
    {
        return $this->readLength;
    }

    /**
     * @param string $readLength
     */
    public function setReadLength($readLength)
    {
        $this->readLength = $readLength;
    }

    /**
     * @return int
     */
    public function getWriteOffset()
    {
        return $this->writeOffset;
    }

    /**
     * @param int $writeOffset
     */
    public function setWriteOffset($writeOffset)
    {
        $this->writeOffset = $writeOffset;
    }

    /**
     * @return int
     */
    public function getWriteLength()
    {
        return $this->writeLength;
    }

    /**
     * @param int $writeLength
     */
    public function setWriteLength($writeLength)
    {
        $this->writeLength = $writeLength;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }
}
