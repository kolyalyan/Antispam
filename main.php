<?php
    $text = $_POST['text'];

    function emojiCheck($text){
        $matches = [];
        mb_ereg('/[(\x{d83d}\x{dd78)(\x{d83c}\x{df35)(\x{d83c}\x{df84)(\x{d83c}\x{df32)(\x{d83c}\x{df33)(\x{d83c}\x{df34)(\x{d83c}\x{df31)(\x{d83c}\x{df3f)(\x{2618}\x{fe0f)(\x{d83c}\x{df40)(\x{d83c}\x{df43)(\x{d83c}\x{df42)(\x{d83c}\x{df41)(\x{d83c}\x{df44)(\x{d83d}\x{dd25)(\x{26a1}\x{fe0f)(\x{d83d}\x{dca5)(\x{2728)(\x{d83c}\x{df08)(\x{2744}\x{fe0f)(\x{d83d}\x{dca6)(\x{d83d}\x{dca8)(\x{d83c}\x{df2c)(\x{d83c}\x{df6d)(\x{d83c}\x{df6c)(\x{d83c}\x{df6b)(\x{d83d}\x{dcab)(\x{2b50}\x{fe0f)(\x{d83c}\x{df1f)]/', $text, $matches);
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