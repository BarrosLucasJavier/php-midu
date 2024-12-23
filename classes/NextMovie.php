<?php

declare(strict_types=1);

class NextMovie
{
    public function __construct(
        private int $days_until,
        private string $title,
        private string $following_production,
        private string $release_date,
        private string $poster_url,
        private string $overview,
    ) {}

    public function get_until_message(): string
    {
        $days = $this->days_until;
        return match (true) {
            $days === 0 => "Hoy se estrena",
            $days === 1 => "mañana se estrena",
            $days < 7   => "Esta semana se estrena",
            $days < 30  => "Este me se estrena...",
            default     => "$days días hasta el estreno",
        };
    }

    public static function fetch_and_create_movie(string $api_url): NextMovie
    {
        # Inicializar una nueva sesión de cURL; ch = cURL handle
        $ch = curl_init($api_url);
        // indicar que queremos recibir el resultado de la peticion y no mostrarla en pantalla
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        // ejecutar la petición y guardamos el resultado
        $result = curl_exec($ch);
        $data = json_decode($result, true);
        curl_close($ch);
        return new self(
            $data["days_until"],
            $data["title"],
            $data["following_production"]["title"] ?? "Desconocido",
            $data["release_date"],
            $data["poster_url"],
            $data["overview"],
        );
    }

    public function get_data()
    {
        return get_object_vars($this);
    }
}
