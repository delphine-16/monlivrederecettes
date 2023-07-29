<?php

namespace Core\Tools;


defined('FROM_INDEX') or die('Nein!');


/**
 * Debug : offre quelques fonctions de débug
 */
class Debug
{
    const DEBUT = 0; //utile à la methode charge()
    const FIN = 1; //utilise à la methode charge()

    static $debut;


    /**
     * Debug::print_r : comme un print_r mais mieux affiché
     *
     * @param array $tab : le tableau à afficher
     * @return void
     */
    static function print_r(array $tab)
    {
        echo '<pre>';
        print_r($tab);
        echo '</pre>';
    }


    static public function var_dump(...$var)
    {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }



    /**
     * Debug::charge : permet de meusurer la charge de notre appli ou d'un bout (Temps + RAM)
     *
     * @param int $etape : Début ou fin du  du bout audité
     * @return void
     */
    public static function charge(int $etape = Debug::DEBUT)
    {
        $time = microtime(true);

        if ($etape == Debug::DEBUT) {
            self::$debut = $time;
        } else {
            $new_time = microtime(true);
            $time = $new_time - self::$debut;

            function convert($size) // pompé sur php.net
            {
                $unit = array('o', 'Ko', 'Mo', 'Go', 'To', 'Po');
                return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
            }


            echo '<br>---------------------------------------------<br>';
            echo 'Durée du scipt : ' . number_format($time, 3) . ' secondes <br>';
            echo 'Mémoire utilisée : ' . convert(memory_get_usage());
            echo '<br>---------------------------------------------<br>';
        }
    }


    public static function afficheSession(string $clef = null)
    {
        echo '<br>---------------------------------------------<br>';

        if (is_null($clef)) {
            echo 'Variables de session';
            self::print_r($_SESSION);
        } else {
            echo 'Variables de la session ' . $clef;
            self::print_r($_SESSION[$clef]);
        }

        echo '<br>---------------------------------------------<br>';
    }
}
