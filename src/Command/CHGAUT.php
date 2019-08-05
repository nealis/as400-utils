<?php

namespace Nealis\As400Utils\Command;

use Nealis\As400Utils\Command;
use Exception;

/**
 * Change Auth to a Path
 *
 * @author Cassiano Vailati <cassvail>
 */
class CHGAUT extends Command
{

    /**
     * @param string $path
     * @param string $user
     * @param string $auth
     * @return mixed
     * @throws \Exception
     */
    public function execute($path='/usr/local/ESC', $user='QTMHHTTP', $auth='*RWX')
    {
        if(empty($path))
            throw new Exception('CHGAUT expects a non empty path');

        return $this->executeCommand("CHGAUT OBJ('$path') USER($user) DTAAUT($auth) OBJAUT(*ALL) SUBTREE(*ALL)");
    }

}
