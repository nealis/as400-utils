<?php

namespace As400Utils;

trait XMLToolkitAwareTrait
{
    /**
     * @var XMLToolkit
     */
    protected $xmlToolkit;

    /**
     * @return XMLToolkit
     */
    public function getXmlToolkit()
    {
        return $this->xmlToolkit;
    }

    /**
     * @param XMLToolkit $xmlToolkit
     */
    public function setXmlToolkit($xmlToolkit)
    {
        $this->xmlToolkit = $xmlToolkit;
    }
}
