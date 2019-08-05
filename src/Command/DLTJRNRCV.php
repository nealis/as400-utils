<?php

namespace Nealis\As400Utils\Command;

use Nealis\As400Utils\Command;
use Exception;

/**
 * Delete Journal Receivers
 *
 * @author Cassiano Vailati <cassvail>
 */
class DLTJRNRCV extends Command
{

    /**
     * @param string $library
     * @param string $name
     * @return mixed
     * @throws \Exception
     */
    public function execute($journalReceiverLibrary='', $journalReceiverName='')
    {
        if(empty($journalReceiverName)) $journalReceiverName = 'QSQJRN*';

        if(empty($journalReceiverLibrary) || empty($journalReceiverName))
            throw new Exception('DLTJRNRCV expects a non empty journal receiver library and name');

        return $this->executeCommand("DLTJRNRCV JRNRCV($journalReceiverLibrary/$journalReceiverName) DLTOPT(*IGNINQMSG)");
    }

}


