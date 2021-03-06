<?php

namespace lalocespedes\Cfdimx\Elementos\Cfdi;

use lalocespedes\Validation\Validator as v;

/**
 * 
 */
class Conceptos
{
    protected $conceptos;

    function __construct($xml, $comprobante, array $data)
    {
        $this->conceptos = $xml->createElement("cfdi:Conceptos");

        $comprobante->appendChild($this->conceptos);
        
        foreach ($data as $key => $item) {

            $concepto = $xml->createElement("cfdi:Concepto");
            $this->conceptos->appendChild($concepto);

            foreach ($item as $key => $val) {
		        $val = preg_replace('/\s+/', ' ', $val); // Regla 5a y 5c
		        $val = trim($val); // Regla 5b
		        if (strlen($val)>0) { // Regla 6
		            $val = utf8_encode(str_replace("|","/",$val)); // Regla 1
		            $concepto->setAttribute($key,$val);
		        }
		    }
        }
    }
}
