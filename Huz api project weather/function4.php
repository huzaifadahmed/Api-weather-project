<?php
    
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];

    $apicall = file_get_contents("https://api.openweathermap.org/data/2.5/forecast?lat=".$lat."&lon=".$lng."&appid=980151be8da26142786766e2acb2cd05");

    $content = json_decode($apicall,true);

    echo "<div><table class='table table-sm text-nowrap' style='font-size:14px'>
    <tr>
        <td><strong>Main</strong></td>
        <td>".$content['list'][0]['weather'][0]['main']."</td>
    </tr>
    <tr>
        <td><strong>Description</strong></td>
        <td>".$content['list'][0]['weather'][0]['description']."</td>
    </tr>
    <tr>
        <td><strong>Temperature</strong></td>
        <td>".$content['list'][0]['main']['temp']-'273'. "&#8451 </td>
    </tr>
    <tr>
        <td><strong>Visibility</strong></td>
        <td>".$content['list'][0]['visibility']." m</td>
    </tr>
    <tr>
        <td><strong>Wind Speed</strong></td>
        <td>".$content['list'][0]['wind']['speed']." m/s</td>
    </tr>
    <tr>
        <td><strong>Wind Direction</strong></td>
        <td>".$content['list'][0]['wind']['deg']. "&deg</td>
    </tr>
    </table></div>";

?>