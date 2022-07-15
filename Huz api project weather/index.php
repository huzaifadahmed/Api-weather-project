<?php

?>

<head>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <style>
        body{

        }
        .container1{
            width:500px;
            height:40px;

        }
        .container2{
            width:100%;
            height:80px;
            background-color:lightblue;
        }
        #inputForm{
            margin:0 auto;
            width:500px;
            padding:20px;
        }

        #input{
            width:300px;
        }

        #submit{
            margin-left:20px;
        }

        #message, #message2{
            width:200px;
            display:none;
        }

        #map {
            height: 500px;
            width:100%;
        }

        #forecastCardDeck{
            width:100%;
            height:500px;
            background-image:url("images/windsock.png");
            background-size:cover;
            margin:0;
        }

        .card-deck{
            margin:30px 0;
        }

        #header{
            background-color:lightblue;
        }

        #text1{
            font-family:"Courier New";
            font-size:20px;
            float:left;
            margin-top:30px;
            margin-left:30px;
        }

        #text2{
            font-family:"Courier New";
            font-size:20px;
            float:right;
            margin-top:30px;
            margin-right:100px;
        }

 


    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light" id="header">
    <a class="navbar-brand" href="#">What's The Weather</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
        <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
        </div>
    </div>
    </nav>

    <div class="container1" id="map"></div>

    <div class="container2" id="content">
        <span id="text1"><strong>Enter a city...</strong></span>
        <span id="text2"><strong>...Or click anywhere on the map!</strong></span>
        <form class="form-inline" id="inputForm">
            <input type="text" id="input" class="form-control" placeholder="Enter a city...">
            <button type="button" class="btn btn-primary" id="submit" value="submit">Submit</button>
        </form>

        <div class="alert alert-success" role="alert" id="message">
        </div>
        <div class="alert alert-danger" role="alert" id="message2">

    </div>
    
    <div class="card-deck" id="forecastCardDeck">

    </div>
    <div id="test"></div>
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQDgPJXY3g1LD7svXOM6fd1HFzhlUfbRc&callback=initMap&v=weekly" defer></script>
    <script type="text/javascript">


        
        let map;

        function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 43.655, lng: -79.425 },
            zoom: 10,
        });
        
        map.addListener("click",(e)=>{
            placeMarkerAndPanTo(e.latLng,map);
        });
        }
        function placeMarkerAndPanTo(latLng,map){
            const marker1 = new google.maps.Marker({
                position:latLng,
                map:map,
            });
            map.panTo(latLng);
            console.log(latLng.lat);
            $.ajax({
                type:'post',
                url:'function4.php',
                data:{
                    lat:latLng.lat,
                    lng:latLng.lng,
                },
                success:function(result4){
                    let coordmessage = result4;
                    const infoWindow = new google.maps.InfoWindow({
                        content: coordmessage
                    });
                    infoWindow.open(map,marker1);
                }
                                
            })


        }

        window.initMap = initMap;
    
        $("#submit").click(function(){

            $.ajax({
                type:'post',
                url:'function.php',
                data:{
                    userInput:$("#input").val(),

                },
                success:function(result){
                    $("#message").html(result).show();

                }
            })

            $.ajax({
                type:'post',
                url:'function2.php',
                data:{
                    userInput:$("#input").val(),
                },
                success:function(result2){
                    const array = result2.split(" ");
                    var lngInt = parseFloat(array[0]);
                    var latInt = parseFloat(array[1]);
                    var link = parseFloat(array[2]);
                    map.setCenter({
                        lat: latInt,
                        lng: lngInt
                    });
                    map.setZoom(9);
                    const marker = new google.maps.Marker({
                        position: {lat: latInt, lng:lngInt},
                        map,
                        label: "A",
                        icon: "images/"+link+".png",
                        title:$("#input").val(),
                    });
                    const infoWindow = new google.maps.InfoWindow({
                        content: document.getElementById('message')
                    });
                    infoWindow.open(map,marker);

                }
                
            })
            $.ajax({
                type:'post',
                url:'function3.php',
                data:{
                    userInput:$("#input").val(),

                },
                success:function(result3){
                    $("#forecastCardDeck").html(result3).show();


                }
            })
        })




        


    </script>

</body>