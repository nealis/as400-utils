<?php

namespace As400Utils\Command;

use As400Utils\Command;
use Exception;

/**
 * Creates a new Journal Receiver
 *
 * @author Cassiano Vailati <cassvail>
 */
class CHGJRN extends Command
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
            throw new Exception('CHGJRN expects a non empty journal library and name');

        return $this->executeCommand("CHGJRN JRN($journalLibrary/$journalName) JRNRCV(*GEN)");
    }

}
