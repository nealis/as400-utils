<?php

namespace Nealis\As400Utils\Command;

use Nealis\As400Utils\Command;
use Exception;

/**
 * Print libl to spool file
 * Spool file read is not implemented yet (WRKSPLF [USERNAME])
 *
 * @author Cassiano Vailati <cassvail>
 */
class DSPLIBL extends Command
{
    /**
     * @return array|bool
     * @throws Exception
     */
    public function execute()
    {
        $result =  $this->executeCommand("DSPLIBL OUTPUT(*PRINT)", false);
        return $result;//['RTNVAR'];
    }

}
