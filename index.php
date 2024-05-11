<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación Clima</title>
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
            </div><br>
            <button type="submit" class="btn-success">Obtener Clima</button>
        </form>
    </div>
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

        $temp = $weather_data['main']['temp'];
        $temp_celsius = $temp;
        $humidity = $weather_data['main']['humidity'];
        $tempmin = round($weather_data['main']['temp_min']);
        $tempmax = round($weather_data['main']['temp_max']);
        $sensacion = round($weather_data['main']['feels_like']);
        $estacion = $weather_data['wind']['speed'];
        $latitud = $weather_data['coord']['lat'];
        $longitud = $weather_data['coord']['lon'];
        
        echo "<div class='weather-info'>";
            echo "<p style='font-size: 50px; font-weight: bold'>$temp °C</p>";
            echo "<p style='font-size: 35px'>$weather_desc</p><br>";
            echo "<svg width='20' height='20' viewBox='0 0 24 24' stroke-width='1.5' stroke='#ffffff' fill='none' stroke-linecap='round' stroke-linejoin='round'>
            <path stroke='none' d='M0 0h24v24H0z' fill='none'/>
            <path d='M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0' />
            <path d='M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z' />
            <p style='display: inline; font-size: 25px'> $city 
                <span style='font-size: 15px'>$latitud | $longitud</span>
            <p>";
            echo "<p>$tempmin °C / $tempmax °C | Sensación termina: $sensacion °C</p><br>";
            echo "
            <p style='display: inline'>
                <svg width='20' height='20' viewBox='0 0 24 24' stroke-width='1.5' stroke='#ffffff' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                <path stroke='none' d='M0 0h24v24H0z' fill='none'/>
                <path d='M18.602 12.004a6.66 6.66 0 0 0 -.538 -1.127l-4.89 -7.26c-.42 -.625 -1.287 -.803 -1.936 -.397a1.376 1.376 0 0 0 -.41 .397l-4.893 7.26c-1.695 2.838 -1.035 6.441 1.567 8.546c2.142 1.734 5.092 2.04 7.519 .919' />
                <path d='M19 16v3' />
                <path d='M19 22v.01' />
                </svg>
                <b>Humedad:</b> $humidity%
            </p>";
            echo "
            <p >
                <svg width='20' height='20' viewBox='0 0 24 24' stroke-width='1.5' stroke='#ffffff' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                <path stroke='none' d='M0 0h24v24H0z' fill='none'/>
                <path d='M5 8h8.5a2.5 2.5 0 1 0 -2.34 -3.24' />
                <path d='M3 12h15.5a2.5 2.5 0 1 1 -2.34 3.24' />
                <path d='M4 16h5.5a2.5 2.5 0 1 1 -2.34 3.24' /></svg> 
                <b>Viento:</b> $estacion km/h
            </p>";
            echo "<a href='index.php'><button type='button'>Limpiar</button></a>";
        echo "</div>";
    } 
    else {
        echo "<p>Ciudad ingresada no encontrada. Por favor intentalo de nuevo.</p>";
    }
}
?>