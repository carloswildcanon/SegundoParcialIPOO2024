<?php
class ContratoViaWeb  extends Contrato {
    private  $descuento;
   
    public function __construct($fechaInicio, $fechaVencimiento, $objPlan,$costo,$seRennueva,$objCliente)
    {
        parent::__construct($fechaInicio, $fechaVencimiento, $objPlan,$costo,$seRennueva,$objCliente);
       $this-> descuento  =10;
       
    }
 
    public function getDescuento () {
        return $this-> descuento   ;
     }
    public function setDescuento ($descuento){
        $this-> descuento   =$descuento   ;
     }
 
    
    public function __toString()
      {
        $cadena=parent::__toString();
       return $cadena . "Descuento: ".$this-> getDescuento (). "\n"; 
             
       }


       public function calcularImporte(){
            $importe=parent::calcularImporte();
            $importe=$importe*(1 - $this->getDescuento()/100);
            return $importe;
        }

}
?>