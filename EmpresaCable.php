<?php

class  EmpresaCable {
    private  $colPlanes ;
    private  $colContratos ;
    public function __construct($colPlanes ,$colContratos)
    {
       $this->colPlanes  =$colPlanes ;
       $this->colContratos  =$colContratos  ;
    }
 
    public function getColPlanes () {
        return $this->colPlanes   ;
     }
    public function setColPlanes ($colPlanes){
        $this->colPlanes=$colPlanes   ;
     }
 
    public function getColContratos () {
        return $this->colContratos    ;
     }
    public function setColContratos ($colContratos){
        $this->colContratos=$colContratos  ;
     }

     public function concatenaPlanes(){
            $cadena="";
            if ($this->getColPlanes()==null){
                $cadena='no hay clientes';
            }else{
                for($i=0;$i<count($this->getColPlanes());$i++){
                    $cadena = $cadena.$this->getColPlanes()[$i]->__toString() ;
                   }
            }
            return $cadena;
         }


         public function concatenaContratos(){
                $cadena="";
                if ($this->getColContratos()==null){
                    $cadena="no hay clientes";
                }else{
                    for($i=0;$i<count($this->getColContratos());$i++){
                        $cadena = $cadena.$this->getColContratos()[$i]->__toString() ;
                       }
                }
                return $cadena;
             }


    public function __toString()
      {
       return "Planes: " .$this->concatenaPlanes() . "\n" . 
              "Contratos: " .$this-> getColContratos () . "\n";
       }
  
  
       public function incorporarContrato($objPlan,$objCliente,$fechaDesde,$fechaVenc,$esViaWeb){
            $colContratos=$this->getColContratos();
            if($colContratos == null){
                $colContratos=[];

            }
            if ($esViaWeb){
                $ncontrato=new ContratoViaWeb($fechaDesde,$fechaVenc,$objPlan,null,null,$objCliente); 
                array_push($colContratos,$ncontrato);
                $this->setColContratos($colContratos);
            }else{
                $ncontrato=new ContratoViaEmpresa($fechaDesde,$fechaVenc,$objPlan,null,null,$objCliente); 
                array_push($colContratos,$ncontrato);
                $this->setColContratos($colContratos);
            }

       }
     
  
       public function retornarImporteContratos($codigoPlan){
            
            $colCont=$this->getColContratos();
            $importe=0;
            foreach ($colCont as $contrato){
                $codPlan=$contrato->getObjPlan()->getCodigo();
                if($codPlan == $codigoPlan){
                   
                    if($contrato instanceof ContratoViaWeb){
                        $importe+=$contrato->calcularImporte();
                    }elseif($contrato instanceof ContratoViaEmpresa){
                        $importe+=$contrato->calcularImporte();
                    }
                }
            }
            return $importe;
       }
  
  
   public function pagarContrato($objContrato){
        $estadoContrato=$objContrato->actualizarEstadoContrato();
        if($estadoContrato == "AL DIA"){
            if($objContrato instanceof ContratoViaWeb){
                $importe=$objContrato->calcularImporte();
            }elseif($objContrato instanceof ContratoViaEmpresa){
                $importe=$objContrato->calcularImporte();
            }
            $objContrato->setSeRennueva("si");
        }elseif($estadoContrato == "Moroso"){
            if($objContrato instanceof ContratoViaWeb){
                $importe=$objContrato->calcularImporte()*1.1;
            }elseif($objContrato instanceof ContratoViaEmpresa){
                $importe=$objContrato->calcularImporte()*1.1;
            }
           $objContrato->setSeRennueva("si");
        }else{
            if($objContrato instanceof ContratoViaWeb){
                $importe=$objContrato->calcularImporte()*1.1;
            }elseif($objContrato instanceof ContratoViaEmpresa){
                $importe=$objContrato->calcularImporte()*1.1;
            }
           $objContrato->setSeRennueva("no");
        }
   }
  
  
   }


  
?>