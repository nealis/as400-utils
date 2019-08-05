<?php

namespace As400Utils;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;

/**
 * Executes IBMi Commands
 *
 * @author Cassiano Vailati <cassvail>
 */
class Command implements LoggerAwareInterface
{
    use XMLToolkitAwareTrait, LoggerAwareTrait;

    /**
     * @var string
     */
    protected $command = '';

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

    public function executeCommand($command, $output = false, $interactive = false)
    {
        $logger = $this->getLogger();
        $toolkitServiceObj = $this->getXmlToolkit()->getToolkitServiceObj();

        try
        {
            $this->debug("Execute Command $command");

            //CLCommand($Command)
            if ($output) {
                $result = $toolkitServiceObj->CLCommandWithOutput($command);
            }
            else if($interactive)
            {
                $result = $toolkitServiceObj->CLInteractiveCommand($command);
            }
            else
            {
                $result = $toolkitServiceObj->CLCommand($command);
            }

            if(!$result)
            {
                if ($logger) {
                    $logger->error($toolkitServiceObj->getErrorMsg());
                    $logger->error($toolkitServiceObj->getErrorCode());
                    $logger->error($toolkitServiceObj->getErrorDataStructXml());
                }

                throw new \Exception(sprintf('%s - %s - %s',
                    $toolkitServiceObj->getErrorMsg(),
                    $toolkitServiceObj->getErrorCode(),
                    $toolkitServiceObj->getErrorDataStructXml())
                );
            }

            //if($logger) $logger->debug($result);
        }
        catch (\Exception $e){
            if ($logger) $logger->error($e->getMessage());
            throw $e;
        }

        return $result;
    }

    public function exec()
    {
        return $this->executeCommand($this->command);
    }

    public function debug($message)
    {
        $logger = $this->getLogger();
        if ($logger) $logger->debug($message);
    }

    public function prettyExecute()
    {
       //TODO Implement method
    }

    /**
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @param string $command
     */
    public function setCommand($command)
    {
        $this->command = $command;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }
}
