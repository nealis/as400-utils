<?php

namespace Nealis\As400Utils;

use Doctrine\DBAL\Connection;
use Monolog\Logger;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;

use ToolkitService;

/**
 * Handles XMLToolkitService instance
 * @author Cassiano Vailati <cassvail>
 */

class XMLToolkit implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    /** @var ToolkitService */
    public $toolkitServiceObj;

    /** @var Connection */
    public $conn;

    /**
     * XMLToolkit constructor.
     * @param $db2Conn
     * @param Logger|null $logger
     */
    public function __construct(Connection $db2Conn, Logger $logger=null)
    {
        $this->setConn($db2Conn);
        $this->setLogger($logger);
    }

    /**
     * @return ToolkitService
     * @throws \Exception
     */
    public function getToolkitServiceObj()
    {
        if (!$this->toolkitServiceObj) {

            $logger = $this->getLogger();

            try {

                $namingMode = DB2_I5_NAMING_ON;
                $toolkitServiceObj = ToolkitService::getInstance($this->getConn(), $namingMode);
                $toolkitServiceObj->setToolkitServiceParams(array(
                    'stateless' => true
                ));

                $this->setToolkitServiceObj($toolkitServiceObj);

            } catch (\Exception $e) {

                if($logger){
                    $logger->error("Error while creating XMLToolkit instance");
                    $logger->error($e->getMessage());
                }

                throw $e;
            }
        }

        return $this->toolkitServiceObj;
    }

    /**
     *
     * @param ToolkitService $toolkitServiceObj
     */
    public function setToolkitServiceObj($toolkitServiceObj)
    {
        $this->toolkitServiceObj = $toolkitServiceObj;
    }

    /**
     * @return mixed
     */
    public function getConn ()
    {
        return $this->conn;
    }

    /**
     * @param mixed $conn
     */
    public function setConn ($conn)
    {
        $this->conn = $conn;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }

}
