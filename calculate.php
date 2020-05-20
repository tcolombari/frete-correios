<?php
    extract($_REQUEST);

    $zipCode = str_replace("-","",$zipCode);
    $zipCodeDest = str_replace("-","",$zipCodeDest);
    $weight = str_replace(",",".",str_replace(".","",$weight));
    $width = str_replace(",",".",str_replace(".","",$width));
    $lenght = str_replace(",",".",str_replace(".","",$lenght));
    $height = str_replace(",",".",str_replace(".","",$height));
    $price = str_replace(",",".",str_replace(".","",$price));

    $info = getFreightInfo($zipCode, $zipCodeDest, $weight, $width, $height, $lenght, $price, $sendType);

function getFreightInfo($zipCode, $zipCodeDest, $weight, $width, $height, $lenght, $price, $sendType) {

    $url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?";
    $url .= "nCdEmpresa=";
    $url .= "&sDsSenha=";
    $url .= "&sCepOrigem=" . $zipCode;
    $url .= "&sCepDestino=" . $zipCodeDest;
    $url .= "&nVlPeso=" . $weight;
    $url .= "&nVlLargura=" . $width;
    $url .= "&nVlAltura=" . $height;
    $url .= "&nCdFormato=1";
    $url .= "&nVlComprimento=" . $lenght;
    $url .= "&sCdMaoPropria=n";
    $url .= "&nVlValorDeclarado=" . $price;
    $url .= "&sCdAvisoRecebimento=n";
    $url .= "&nCdServico=" . $sendType;
    $url .= "&nVlDiametro=0";
    $url .= "&StrRetorno=xml";
    $url .= "&nIndicaCalculo=3";

    $xml = simplexml_load_file($url);
    $sendType = $xml->cServico->Codigo == 40010 ? 'SEDEX' : 'PAC';

    if($xml->cServico->Erro=="0"){
        $arr = [
            'error' => false,
            $sendType,
            $xml->cServico->Valor,
            $xml->cServico->PrazoEntrega
        ];
        echo (json_encode ($arr));
    } else{
        $arr = [
            'error' => true,
            $xml->cServico->MsgErro
        ];
        echo (json_encode ($arr));
        echo $xml->cServico->MsgErro;   
    }
}
?>