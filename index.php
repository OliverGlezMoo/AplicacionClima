<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Clima</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<video autoplay="" loop="" muted="" id="video_background" class="video-wrap" preload="auto" volume="50">
    <source src="Cielo Claro.mkv" type="video/mp4"/>
    Tu navegador no soporta la etiqueda del video
</video>
    <div class="container">
        <h1 id="text-1"> Aplicación del Clima </h1>
        <form method="GET">
            <div class="op">
                <input class="btn-busqueda" type="text" id="city" name="city" placeholder="Escribe el Nombre de la Ciudad" required>
            </div>
            <br>
            <button type="submit" class="btn-success">Obtener Clima</button>
        </form>
    </div>

    <script>
        const convertToAFormatHour = ($zone)=>{
            let hours = Math.floor($zone / 3600).toString()
            let minutes = (Math.floor($zone / 60)%60).toString()
            let seconds = ($zone % 60).toString()
            return `${hours.length == 2 ? hours : "0"+hours}:{minutes.lenght = 2 ? minutes : "0"+minutes}:${seconds.length == 2 ? seconds : "0"+seconds}`
        }
    </script>
</body>
</html>

<?php
if(isset($_GET['city'])){
    $city = $_GET['city'];
    $apiKey = 'e1ec597d520cdd40014ecc980342d897'; // Coloca aquí tu clave de API
    $url = "http://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey&units=metric&lang=sp";
    $weather_data = json_decode(file_get_contents($url), true);

    echo "<div id='weather-info'
    style='
        display: flex;
        justify-content: center;
        background: transparent;
        color: blue;
        line-height: 0.1em;
    '>";

    if($weather_data){
        $weather_desc = $weather_data['weather'][0]['description'];
        #Traduccion de la descripcion
        if ($weather_desc == "overcast clouds") $weather_desc = "Cielo Nublado";
        if ($weather_desc == "clear sky") $weather_desc = "Cielo Despejado";
        if ($weather_desc == "scattered clouds") $weather_desc = "Cielo Disperso";
        if ($weather_desc == "light rain") $weather_desc = "lluvia ligera";
        if ($weather_desc == "few clouds") $weather_desc = "Pocas nubes";
        if ($weather_desc == "broken clouds") $weather_desc = "Nubes rotas";
        if ($weather_desc == "light intensity drizzle") $weather_desc = "Llovizna de intensidad ligera";
        if ($weather_desc == "drizzle") $weather_desc = "Llovizna";

        $temp = $weather_data['main']['temp'];
        $temp_celsius = $temp;
        $humidity = $weather_data['main']['humidity'];
        $presAtmos = $weather_data['main']['pressure'];
        $tempmin = round($weather_data['main']['temp_min']);
        $tempmax = round($weather_data['main']['temp_max']);
        $sensacion = round($weather_data['main']['feels_like']);
        $zone = $weather_data['timezone'];
        
        echo "<div class='weather-info'>";
            echo "<p style='font-size: 50px; font-weight: bold'>$temp °C</p>";
            echo "<p style='font-size: 40px'>$weather_desc</p><br>";
            echo "<p style='font-size: 25px'>$city<p>";
            echo "<svg width='25' height='25' viewBox='0 0 24 24' stroke-width='1.5' stroke='#ffffff' fill='none' stroke-linecap='round' stroke-linejoin='round'>
            <path stroke='none' d='M0 0h24v24H0z' fill='none'/>
            <path d='M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0' />
            <path d='M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z' />";
            echo "<p>$tempmin °C / $tempmax °C | Sensación termina: $sensacion °C</p><br>";
            echo "<p><b>Presion Atmosferica:</b> $presAtmos Pa</p>";
            echo "<p><b>Humedad:</b> $humidity%</p>";
            echo "<a href='index.php'><button type='button'>VOLVER</button></a>";
        echo "</div>";
    } 
    else {
        echo "<p>Ciudad ingresada no encontrada. Por favor intentalo de nuevo.</p>";
    }
}
?>