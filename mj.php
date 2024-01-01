<?php

interface TirageAleatoireInterface
{
    public function lancer();
}

class MJ
{
    public function tirageAleatoire(TirageAleatoireInterface $objetAleatoire)
    {
        return $objetAleatoire->lancer();
    }
}

class DeckAdapter implements TirageAleatoireInterface
{
    private $deck;

    public function __construct(deck $deck)
    {
        $this->deck = $deck;
    }

    public function lancer()
    {
        return $this->deck->retournerCarte();
    }
}

class Deck
{
    private $piocheCartes;

    public function __construct($piocheCartes)
    {
        $this->piocheCartes = $piocheCartes;
    }

    public function retournerCarte()
    {
        return mt_rand(1, $this->piocheCartes);
    }
}

class Coin implements TirageAleatoireInterface
{
    private $nombreLancer;

    public function __construct($nombreLancer)
    {
        $this->nombreLancer = $nombreLancer;
    }

    public function lancer()
    {
        return mt_rand(0, 1);
    }
}

class De implements TirageAleatoireInterface
{
    private $faces;

    public function __construct($faces)
    {
        $this->faces = $faces;
    }

    public function lancer()
    {
        return mt_rand(1, $this->faces);
    }
}

// Exemple d'utilisation
$deck = new Deck(52);
$deckAdapter = new DeckAdapter($deck);

$coin = new Coin(1);
$de = new De(6);

$mj = new MJ();

$resultatDeck = $mj->tirageAleatoire($deckAdapter);
$resultatCoin = $mj->tirageAleatoire($coin);
$resultatDe = $mj->tirageAleatoire($de);

echo "Résultat du tirage du deck : $resultatDeck\n";
echo "Résultat du tirage de la pièce : $resultatCoin\n";
echo "Résultat du tirage du dé : $resultatDe\n";
?>
