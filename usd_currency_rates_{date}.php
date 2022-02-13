<?php
    
    $ch = curl_init();  
    
    curl_setopt($ch, CURLOPT_URL, 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml?5105e8233f9433cf70ac379d6ccc5775');    
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.81 Safari/537.36");
    $data = curl_exec($ch);
    
    $xml=simplexml_load_string($data) or die("Error: Cannot create object");
    
    $fp = fopen('file.csv','w');   

    for($i = 0 ;$i <= 31;$i++){
        $text = array($xml->Cube->Cube->Cube[$i]['currency'],$xml->Cube->Cube->Cube[$i]['rate']);
        fputcsv($fp,$text);
    }
    
?>