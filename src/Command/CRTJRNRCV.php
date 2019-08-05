<?php

namespace Nealis\As400Utils\Command;

use Nealis\As400Utils\Command;
use Exception;

/**
 * Create Journal Receiver
 *
 * @author Cassiano Vailati <cassvail>
 */
class CRTJRNRCV extends Command
{

    /**
     * @param string $library
     * @param string $name
     * @return mixed
     * @throws \Exception
     */
    public function execute($journalReceiverLibrary='', $journalReceiverName='')
    {
        if(empty($journalReceiverName)) $journalReceiverName = 'QSQJRN0001';

        if(empty($journalReceiverLibrary) || empty($journalReceiverName))
            throw new Exception('CRTJRNRCV expects a non empty library and name');

        return $this->executeCommand("CRTJRNRCV JRNRCV($journalReceiverLibrary/$journalReceiverName)");
    }

}
