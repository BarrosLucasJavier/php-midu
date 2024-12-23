<?php

declare(strict_types=1);

function get_data(string $url): array
{
    # Inicializar una nueva sesión de cURL; ch = cURL handle
    $ch = curl_init($url);
    // indicar que queremos recibir el resultado de la peticion y no mostrarla en pantalla
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    // ejecutar la petición y guardamos el resultado
    $result = curl_exec($ch);
    $data = json_decode($result, true);
    curl_close($ch);
    return $data;
}

function get_until_message(int $days): string
{
    return match (true) {
        $days === 0 => "Hoy se estrena",
        $days === 1 => "mañana se estrena",
        $days < 7   => "Esta semana se estrena",
        $days < 30  => "Este me se estrena...",
        default     => "$days días hasta el estreno",
    };
}

function render_template (string $template, array $data = [])
{
    extract($data);
    require "templates/$template.php";
}