<?php

namespace As400Utils\Command;

use As400Utils\Command;
use Exception;

/**
 * Delete a Journal
 *
 * @author Cassiano Vailati <cassvail>
 */
class DLTJRN extends Command
{

    /**
     * @param string $library
     * @param string $name
     * @param string $receiverLibrary
     * @param string $receiverName
     * @return mixed
     * @throws \Exception
     */
    public function execute($journalLibrary='', $journalName='')
    {
        if(empty($journalName)) $journalName = 'QSQJRN';

        if(empty($journalLibrary) || empty($journalName))
            throw new Exception('DLTJRN expects a non empty journal, library and name');

        return $this->executeCommand("DLTJRN JRN($journalLibrary/$journalName)");
    }

}
