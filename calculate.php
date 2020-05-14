<?php

    extract($_REQUEST);

    $zipCode = str_replace("-","",$zipCode);
    $zipCodeDest = str_replace("-","",$zipCodeDest);
    $weight = str_replace(",",".",str_replace(".","",$weight));
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
    $url .= "&sCdMaoProria=n";
    $url .= "&nVlValorDeclarado=" . $price;
    $url .= "&sCdAvisoRecebimento=n";
    $url .= "&nCdServico=" . $sendType;
    $url .= "&nVlDiametro=0";
    $url .= "&StrRetorno=xml";
    $url .= "&nIndicaCalculo=3";

    $xml = simplexml_load_file($url);

    if($xml->cServico->Erro=="0"){
        return $xml;
    } else{
        return $xml->cServico->MsgErro;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Informações de envio</title>
</head>
<body> 
    <h1>Informações de envio</h1>
    <table>
        <thead>
            <tr>
                <th scope="col">CEP Destino</th>
                <th scope="col">Serviço</th>
                <th scope="col">Valor</th>
                <th scope="col">Prazo de Entrega</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $zipCodeDest; ?></td>
                <td><?= ($info->cServico->Codigo == "41106") ? "PAC" : "SEDEX" ; ?></td>
                <td><?= "R$ ".$info->cServico->Valor; ?></td>
                <td><?= $info->cServico->PrazoEntrega . " dias"; ?></td>
            </tr>
        </tbody>
    </table>
    <script src="js/masks.js"></script>
</body>
</html>