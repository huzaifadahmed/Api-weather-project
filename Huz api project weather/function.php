<?php

    $input = $_POST['userInput'];

    
    ini_set('display_errors', '0');

    $error = "";
    
    $apicall = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$input."&appid=980151be8da26142786766e2acb2cd05");

    $content = json_decode($apicall,true);
    if($content['cod']=='200'){
        //print_r($content);
        // echo "Main: ".$content['weather'][0]['main']."<br>Description: ".$content['weather'][0]['description']."<br> Temperature: ".($content['main']['temp']-273). "&#8451 
        // <br> Visibility: ".$content['visibility']." m <br> Wind Speed: ".$content['wind']['speed']." m/s 
        // <br> Wind Direction: ".$content['wind']['deg']. "&deg";

        echo "<div><table class='table table-sm text-nowrap' style='font-size:14px'>
        <tr>
            <td><strong>Main</strong></td>
            <td>".$content['weather'][0]['main']."</td>
        </tr>
        <tr>
            <td><strong>Description</strong></td>
            <td>".$content['weather'][0]['description']."</td>
        </tr>
        <tr>
            <td><strong>Temperature</strong></td>
            <td>".($content['main']['temp']-273). "&#8451 </td>
        </tr>
        <tr>
            <td><strong>Visibility</strong></td>
            <td>".$content['visibility']." m</td>
        </tr>
        <tr>
            <td><strong>Wind Speed</strong></td>
            <td>".$content['wind']['speed']." m/s</td>
        </tr>
        <tr>
            <td><strong>Wind Direction</strong></td>
            <td>".$content['wind']['deg']. "&deg</td>
        </tr>
        </table></div>";
    }

    else{
        $error = "Please enter a valid city.";
    }

    if($error != ""){
        echo $error;
    }

?>