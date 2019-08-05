<?php

namespace Nealis\As400Utils\Command;

use Nealis\As400Utils\Command;

/**
 * Change Job Options
 *
 * @author Cassiano Vailati <cassvail>
 */
class CHGJOB extends Command
{
    /**
     * @param $timeslice
     * @return mixed
     * @throws \Exception
     */
    public function execute($timeslice)
    {
        if(empty($timeslice))
            throw new \Exception('CHGJOB expects non empty timeslice');

        return $this->executeCommand("CHGJOB TIMESLICE($timeslice) PURGE(*YES)");
    }
}
