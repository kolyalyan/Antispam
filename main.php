<?php
    $text = $_POST['text'];

    function emojiCheck($text){
        if(preg_match_all('/.*[🕸🌵🎄🌲🌳🌴🌱🌿☘️🍀🍃🍂🍁🍄🔥⚡️💥✨🌈❄️💦💨🌬🍭🍬🍫💫⭐️🌟]+.*[🕸🌵🎄🌲🌳🌴🌱🌿☘️🍀🍃🍂🍁🍄🔥⚡️💥✨🌈❄️💦💨🌬🍭🍬🍫💫⭐️🌟]+.*/', $text)){
            return True;
        }
        
        $lines = explode("\n", $text);

        foreach($lines as $line){
            echo $line . "\n";
            if(preg_match_all('/^[🕸🌵🎄🌲🌳🌴🌱🌿☘️🍀🍃🍂🍁🍄🔥⚡️💥✨🌈❄️💦💨🌬🍭🍬🍫💫⭐️🌟]|[🕸🌵🎄🌲🌳🌴🌱🌿☘️🍀🍃🍂🍁🍄🔥⚡️💥✨🌈❄️💦💨🌬🍭🍬🍫💫⭐️🌟]$/', $line) > 0){
                return True;
            }
        }

        return False;
    }

    echo emojiCheck($text) ? "Spam" : "Ok";
?>