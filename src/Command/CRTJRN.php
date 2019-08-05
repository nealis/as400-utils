<?php

namespace As400Utils\Command;

use As400Utils\Command;
use Exception;

/**
 * Create a Journal
 *
 * @author Cassiano Vailati <cassvail>
 */
class CRTJRN extends Command
{

    /**
     * @param string $library
     * @param string $name
     * @param string $receiverLibrary
     * @param string $receiverName
     * @return mixed
     * @throws \Exception
     */
    public function execute($journalLibrary='', $journalName='', $journalReceiverLibrary='', $journalReceiverName='')
    {
        if(empty($journalName)) $journalName = 'QSQJRN';
        if(empty($journalReceiverName)) $journalReceiverName = 'QSQJRN0001';

        if(empty($journalLibrary) || empty($journalName) || empty($journalReceiverLibrary) || empty($journalReceiverName))
            throw new Exception('CRTJRN expects a non empty journal and receiver, library and name');

        return $this->executeCommand("CRTJRN JRN($journalLibrary/$journalName) JRNRCV($journalReceiverLibrary/$journalReceiverName) DLTRCV(*YES)");
    }

}
