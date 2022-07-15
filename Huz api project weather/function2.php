<?php

    $input = $_POST['userInput'];
    //$lat = $_POST['lat'];
    //$lon = $_POST['lon'];
    
    ini_set('display_errors', '0');

    $error = "";
    $link = "";
    
    $apicall = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$input."&appid=980151be8da26142786766e2acb2cd05");

    $content = json_decode($apicall,true);
    if($content['cod']=='200'){
        //print_r($content);
        if($content['weather'][0]['main']=='Clear'){
            $link = "1";
        }
        if($content['weather'][0]['main']=='Clouds'){
            $link = "2";
        }
        if($content['weather'][0]['main']=='Drizzle'){
            $link = "5";
        }
        if($content['weather'][0]['main']=='Rain'){
            $link = "6";
        }
        if($content['weather'][0]['main']=='Thunderstorm'){
            $link = "7";
        }
        if($content['weather'][0]['main']=='Snow'){
            $link = "8";
        }
        if($content['weather'][0]['main']=='Mist'){
            $link = "9";
        }
        
        echo $content['coord']['lon']." ".$content['coord']['lat']." ".$link;
    }

    else{
        $error = "Please enter a valid city.";
    }

    if($error != ""){
        echo $error;
    }

?>