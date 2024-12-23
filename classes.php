<?php
class SuperHero
{
    public function __construct(
        readonly public string $name,
        public $powers,
        public $planet)
    {}

    public function attack()
    {
        return "¡$this->name ataca con sus poderes";
    }

    public function description()
    {
        return "$this->name es un superhéroe que viene de
            $this->planet y tiene los siguientes poderes:
            $this->powers";
    }
}
/* class SuperHero
{
    public $name;
    public $powers;
    public $planet;

    public function __construct($name, $powers, $planet)
    {
        $this->name = $name;
        $this->powers = $powers;
        $this->planet = $planet;
    }

    public function attack()
    {
        return "¡$this->name ataca con sus poderes";
    }

    public function description()
    {
        return "$this->name es un superhéroe que viene de
            $this->planet y tiene los siguientes poderes:
            $this->powers";
    }
} */

$hero = new SuperHero("Batman", "Dinero, inteligencia y tecnologia", "Gotham");
