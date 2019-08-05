<?php

namespace As400Utils\Command;

use As400Utils\Command;
use Exception;

/**
 * Change Auth to a Path
 *
 * @author Cassiano Vailati <cassvail>
 */
class RTVDTAARA extends Command
{
    /**
     * @param $dataAreaName
     * @param string $dataAreaLibrary
     * @return mixed
     * @throws Exception
     */
    public function execute($dataAreaName, $dataAreaLibrary='*LIBL')
    {
        if(empty($dataAreaName))
            throw new Exception('RTVDTAARA expects a non empty DataArea name');

        $result =  $this->executeCommand("RTVDTAARA DTAARA($dataAreaLibrary/$dataAreaName *ALL) RTNVAR(?)", true);
        //$result =  $this->executeCommand("RTVDTAARA DTAARA($dataAreaLibrary/$dataAreaName ($offset $lenght)) RTNVAR(?)", true);

        return $result['RTNVAR'];
    }

}
