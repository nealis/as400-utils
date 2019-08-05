<?php

namespace As400Utils\Command;

use As400Utils\Command;
use Exception;

/**
 * Deletes a Library
 *
 * @author Guido Sangiovanni <gsangiov>
 */
class DLTLIB extends Command
{
    /**
     * @param string $libraryName
     * @return mixed
     * @throws \Exception
     */
    public function execute($libraryName = '')
    {
        if(empty($libraryName)) {
            throw new Exception('DLTLIB expects a not empty library name');
        }

        return $this->executeCommand("DLTLIB LIB($libraryName)");
    }
}
