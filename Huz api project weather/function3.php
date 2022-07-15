<?php
    $input = $_POST['userInput'];
    
    ini_set('display_errors', '0');

    $apicalllatlon = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$input."&appid=980151be8da26142786766e2acb2cd05");

    $contentlatlon = json_decode($apicalllatlon,true);
    
    

    $apicall = file_get_contents("https://api.openweathermap.org/data/2.5/forecast?lat=".$contentlatlon['coord']['lat']."&lon=".$contentlatlon['coord']['lon']."&appid=980151be8da26142786766e2acb2cd05");

    $content = json_decode($apicall,true);

    $link = "";

    if($content['cod']=='200'){
        //print_r($content);
        //print_r ("Main: ".$content['list']['0']['weather']['0']['main']."<br> Description: ".$content['list']['0']['weather']['0']['description'].
        //"<br>Temperature: ".$content['list']['0']['main']['temp']-'273'."&#8451<br>Visibility: ".$content['list']['0']['visibility'].
        //" m<br>Wind Speed: ".$content['list']['0']['wind']['speed']." m/s<br>Wind Direction: ".$content['list']['0']['wind']['deg']."&deg<br>Time: ".$content['list']['0']['dt_txt']);
        for($i=0;$i<5;$i++){
            if($content['list'][$i]['weather'][0]['main']=='Clear'){
                $link[$i] = "1";
            }
            if($content['list'][$i]['weather'][0]['main']=='Clouds'){
                $link[$i] = "2";
            }
            if($content['list'][$i]['weather'][0]['main']=='Drizzle'){
                $link[$i] = "5";
            }
            if($content['list'][$i]['weather'][0]['main']=='Rain'){
                $link[$i] = "6";
            }
            if($content['list'][$i]['weather'][0]['main']=='Thunderstorm'){
                $link[$i] = "7";
            }
            if($content['list'][$i]['weather'][0]['main']=='Snow'){
                $link[$i] = "8";
            }
            if($content['list'][$i]['weather'][0]['main']=='Mist'){
                $link[$i]= "9";
            }
            echo '<div class="card" style="height:400px;margin-top:40px">
                <img class="card-img-top" id="iconimage" src="images/'.$link[$i].'.png" alt="Card image cap" style="height:100px;width:100px;margin:0 auto">
                <div class="card-body">
                <h5 class="card-title" style="text-align:center">'.$content['list'][$i]['weather'][0]['main'].'</h5>
                <p class="card-text"><strong>Description:</strong> '.$content['list'][$i]['weather'][0]['description'].'<br><strong>Temperature:</strong> '.$content['list'][$i]['main']['temp']-'273'.'&#8451<br><strong>Visibility:</strong> '.$content['list'][$i]['visibility'].' m<br><strong>Wind Speed:</strong> '.$content['list'][$i]['wind']['speed'].' m/s<br><strong>Wind Direction:</strong> '.$content['list'][$i]['wind']['deg'].'&deg<br><strong>Time:</strong><em> '.$content['list'][$i]['dt_txt'].'</em></p>
                </div>
            </div>';
        }

        // echo'
        // <div class="card">
        //     <img class="card-img-top" src="..." alt="Card image cap">
        //     <div class="card-body">
        //     <h5 class="card-title">'.$content['list']['0']['weather']['0']['main'].'</h5>
        //     <p class="card-text"><strong>Description:</strong> '.$content['list']['0']['weather']['0']['description'].'<br><strong>Temperature:</strong> '.$content['list']['0']['main']['temp']-'273'.'&#8451<br><strong>Visibility:</strong> '.$content['list']['0']['visibility'].' m<br><strong>Wind Speed:</strong> '.$content['list']['0']['wind']['speed'].' m/s<br><strong>Wind Direction:</strong> '.$content['list']['0']['wind']['deg'].'&deg<br>Time: '.$content['list']['0']['dt_txt'].'</p>
        //     <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        //     </div>
        // </div>
        // <div class="card">
        //     <img class="card-img-top" src="..." alt="Card image cap">
        //     <div class="card-body">
        //     <h5 class="card-title">Card title</h5>
        //     <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
        //     <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        //     </div>
        // </div>
        // <div class="card">
        //     <img class="card-img-top" src="..." alt="Card image cap">
        //     <div class="card-body">
        //     <h5 class="card-title">Card title</h5>
        //     <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
        //     <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        //     </div>
        // </div>
        // <div class="card">
        //     <img class="card-img-top" src="..." alt="Card image cap">
        //     <div class="card-body">
        //     <h5 class="card-title">Card title</h5>
        //     <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
        //     <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        //     </div>
        // </div>
        // <div class="card">
        //     <img class="card-img-top" src="..." alt="Card image cap">
        //     <div class="card-body">
        //     <h5 class="card-title">Card title</h5>
        //     <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
        //     <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        //     </div>
        // </div>';
    
    }

?>