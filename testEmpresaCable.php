<?php
include_once("Canal.php");
include_once("Plan.php");
include_once("Cliente.php");
include_once("Contrato.php");
include_once("ContratoViaWeb.php");
include_once("ContratoViaEmpresa.php");
include_once("testEmpresaCable.php");

$objEmpresaCable=new EmpresaCable([],[]);

$objCanal1=new Canal("noticias",10,"no","no");
$objCanal2=new Canal("películas",15,"si","no");
$objCanal3=new Canal("deportivo",20,"si","si");

$objPlan1=new Plan(109,[],30);
$objPlan1->setColCanales([$objCanal1,$objCanal2]);

$objPlan2=new Plan(110,[],30);
$objPlan2->setColCanales([$objCanal3,$objCanal2]);

$objPlan3=new Plan(111,[],30);
$objPlan3->setColCanales([$objCanal1,$objCanal3]);

$objCliente=new Cliente(null,213654,"lilas 214");

$objContrato1=new ContratoViaEmpresa(null,null,null,null,null,null);

$objContrato2=new ContratoViaWeb("2024-04-2","2024-05-02",$objPlan1,500,"si",$objCliente);
//$fechaInicio, $fechaVencimiento, $objPlan,$costo,$seRennueva,$objCliente
$objContrato3=new ContratoViaWeb(null,null,null,null,null,null);


$imp1=$objContrato1->calcularImporte();
echo $imp1 . "\n";

$imp2=$objContrato2->calcularImporte();
echo $imp2 . "\n";

$imp3=$objContrato3->calcularImporte();
echo $imp3 . "\n";

//$objEmpresaCable->incorporaPlan($objPlan1);
//$objEmpresaCable->incorporaPlan($objPlan2);
//$objEmpresaCable->incorporaPlan$objPlan3);

$objEmpresaCable->incorporarContrato($objPlan1,$objCliente,"2024-061-2","2024-07-12",true);

$objEmpresaCable->incorporarContrato($objPlan3,$objCliente,"2024-061-2","2024-07-12",true);
$objEmpresaCable->pagarContrato($objContrato2);
$objEmpresaCable->retornarImporteContratos($codigoPlan3);
?>