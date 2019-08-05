<?php

namespace As400Utils\Command;

use As400Utils\Command;
use Exception;

/**
 * Start journaling on a table
 *
 * @author Cassiano Vailati <cassvail>
 */
class STRJRNPF extends Command
{

    /**
     * @param string $library
     * @param string $name
     * @param string $journalLibrary
     * @param string $journalName
     * @return mixed
     * @throws \Exception
     */
    public function execute($library='', $table='', $journalLibrary='', $journalName='')
    {
        if(empty($journalName)) $journalName = 'QSQJRN';

        if(empty($library) || empty($table) || empty($journalLibrary) || empty($journalName))
            throw new Exception('STRJRNPF expects a non empty library, name and journal');

        return $this->executeCommand("STRJRNPF FILE($library/$table) JRN($journalLibrary/$journalName)");
    }

}
