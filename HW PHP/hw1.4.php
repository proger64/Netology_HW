<?php 
$city = "Ufa";
 
 // формируем урл для запроса

$url = "http://api.openweathermap.org/data/2.5/find?q=$city,RU&type=like&units=metric&APPID=bd67391eb9499f2f8093595e5ce5f1c8";

// делаем запрос к апи

$data = @file_get_contents($url);

// если получили данные

if($data){
    
    // декодируем полученные данные
    
    $dataJson = json_decode($data);
    
    // получаем только нужные данные
    
    $arrayWeather = $dataJson->list;
    
    // выводим данные
    
    foreach($arrayWeather as $day){
        echo "Погода в городе". " " . $city . " " . "на" . " " . (date("d - F - Y ")) . "<br/>";
        echo "Температура: " . $day->main->temp . "<br/>";
        echo "Скорость ветра: " . $day->wind->speed . "<br/>";
        echo "Погода: " . $day->weather[0]->description  ;
        if ($day->weather[0]->description === snow) {
           echo "<img src='https://image.flaticon.com/icons/svg/106/106043.svg' width=30 height=30 >" . "<br/>";
        }elseif ($day->weather[0]->description == "Sky is Clear") {
            echo "<img src='https://image.flaticon.com/icons/svg/106/106061.svg' width=30 height=30>" . "<br/>";
        }elseif ($day->weather[0]->description == "light snow"){
             echo "<img src='https://image.flaticon.com/icons/svg/106/106056.svg' width=30 height=30>" . "<br/>";
        }elseif ($day->weather[0]->description == "broken clouds"){
            echo "<img src='https://image.flaticon.com/icons/svg/106/106064.svg' width=30 height=30>" . "<br/>";
        }elseif ($day->weather[0]->description == "scattered clouds"){
            echo "<img src='https://image.flaticon.com/icons/svg/106/106064.svg' width=30 height=30>" . "<br/>";
        }
        echo "<br/>";
        echo "Давление: " . $day->main->pressure . "<br/>";
        echo "<hr/>";
    }
}else{
    
    echo "Сервер не доступен!";
}


