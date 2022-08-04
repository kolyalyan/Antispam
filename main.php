<?php
    $text = $_POST['text'];

    function emojiCheck($text){
        $matches = [];
        mb_ereg('/[(\x{dd83d}\x{dd78})]/', $text, $matches);
        var_dump($matches);
        /*
        $lines = explode("\n", $text);

        foreach($lines as $line){
            echo $line . "\n";
            if(mb_ereg('/[🕸🌵🎄🌲🌳🌴🌱🌿☘️🍀🍃🍂🍁🍄🔥⚡️💥✨🌈❄️💦💨🌬🍭🍬🍫💫⭐️🌟]$/', $line) > 0){
                return True;
            }
        }
*/
        return False;
    }

    echo emojiCheck($text) ? "Spam" : "Ok";
?>