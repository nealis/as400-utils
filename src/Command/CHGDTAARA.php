<?php

namespace Nealis\As400Utils\Command;

use Nealis\As400Utils\Command;
use Exception;

/**
 * Change Auth to a Path
 *
 * @author Cassiano Vailati <cassvail>
 */
class CHGDTAARA extends Command
{
    /**
     * @param $dataAreaName
     * @param $value
     * @param string $dataAreaLibrary
     * @return array|bool
     * @throws Exception
     */
    public function execute($dataAreaName, $value, $dataAreaLibrary='*LIBL')
    {
        if(empty($dataAreaName))
            throw new Exception('CHGDTAARA expects a non empty DataArea name');

        return $this->executeCommand("CHGDTAARA DTAARA($dataAreaLibrary/$dataAreaName *ALL) VALUE($value)");
        //return $this->executeCommand("CHGDTAARA DTAARA($dataAreaLibrary/$dataAreaName ($offset $lenght)) VALUE($value)");
    }
}
