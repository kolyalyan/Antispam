<?php
    $text = $_POST['text'];

    function emojiCheck($text){
        //if(preg_match_all('/[🕸🌵🎄🌲🌳🌴🌱🌿☘️🍀🍃🍂🍁🍄🔥⚡️💥✨🌈❄️💦💨🌬🍭🍬🍫💫⭐️🌟]+/', $text) > 1){
        //    return True;
        //}

        $lines = explode("\n", $text);

        foreach($lines as $line){
            echo $line . "\n";
            if(mb_ereg('/[🕸🌵🎄🌲🌳🌴🌱🌿☘️🍀🍃🍂🍁🍄🔥⚡️💥✨🌈❄️💦💨🌬🍭🍬🍫💫⭐️🌟]$/', $line) > 0){
                return True;
            }
        }

        return False;
    }

    echo emojiCheck($text) ? "Spam" : "Ok";
?>