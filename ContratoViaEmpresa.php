<?php
class ContratoViaEmpresa  extends Contrato {
    
    public function __construct($fechaInicio, $fechaVencimiento, $objPlan,$costo,$seRennueva,$objCliente)
    {
       parent::__construct($fechaInicio, $fechaVencimiento, $objPlan,$costo,$seRennueva,$objCliente);
    }
 
    
    public function __toString()
      {
        $cadena=parent::__toString();
       return $cadena;
       }


       public function calcularImporte(){
        
        $colCanales=$this->getObjPlan()->getColCanales();
        $sumaImpCan=0;
        foreach($colCanales as $canal){
            $sumaImpCan+=$canal->getImporte();
        }
        $importe=parent::calcularImporte();
        $importe=$importe + $sumaImpCan;
        return $importe;
    }
  }


?>
