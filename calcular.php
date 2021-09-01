<?php
header("Access-Control-Allow-Origin: *"); 
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
//$variaveis_extras = http_build_query($_POST);

//Variáveis utilizadas como padrao (nao modificadas)
/*
&sCdAvisoRecebimento=n
&sCdMaoPropria=n
&nIndicaCalculo=3
&nVlValorDeclarado=0
&StrRetorno=xml

###Variaveis nossas INPUTS###

//Variaveis declaradas pelo cliente no formulario
&sCepDestino=04547000
&nCdServico=04510//Tipo de entrega Sedex, Sedex10, PAC etc

//Variaveis declaradas internamente pela FairuzArtes
&sCepOrigem=04034020 #Valor fixo de referencia nossa
&nCdFormato=1 //Praticamente sempre será caixa igual a 1
&nVlPeso=1
&nVlComprimento=20
&nVlAltura=20
&nVlLargura=20
&nVlDiametro=0
*/


$urlcliente = http_build_query($_POST);

$urlFixo = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=04037020&nCdFormato=1&sCdMaoPropria=n&nVlValorDeclarado=0&sCdAvisoRecebimento=n&nIndicaCalculo=3&StrRetorno=xml";

$urlProduto = "&nVlPeso=1&nVlComprimento=20&nVlAltura=20&nVlLargura=20&nVlDiametro=0&";
//$urlcliente = "&sCepDestino=71746003&nCdServico=04510";
$urlFinal = $urlFixo.$urlProduto.$urlcliente;


//$urlteste = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=08082650&sDsSenha=564321&sCepOrigem=04037020&sCepDestino=71746003&nVlPeso=1&nCdFormato=1&nVlComprimento=20&nVlAltura=20&nVlLargura=20&sCdMaoPropria=n&nVlValorDeclarado=0&sCdAvisoRecebimento=n&nCdServico=04510&nVlDiametro=0&StrRetorno=xml&nIndicaCalculo=3";
$urlteste = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCdAvisoRecebimento=n&sCdMaoPropria=n&nVlValorDeclarado=0&sCepOrigem=04037020&nCdFormato=1&nVlComprimento=20&nVlAltura=20&nVlLargura=20&nVlDiametro=10&sCepDestino=71746003&nCdServico=04014&StrRetorno=xml&nIndicaCalculo=3";

$unparsedResult =  file_get_contents($urlFinal);
//$unparsedResult =  getFileContent($urlteste);
//$parsedResult = simplexml_load_string($unparsedResult);
$retorno = array(
    'preco' => strval($parsedResult->cServico->Valor),
    'prazo' => strval($parsedResult->cServico->PrazoEntrega)
);
die($unparsedResult);
//die(json_encode($unparsedResult));
//die(json_encode($parsedResult));
//die(json_encode($retorno));
?>