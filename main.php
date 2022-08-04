<?php
    $text = base64_decode($_POST['text']);

    function emojiCheck($text){
        $lines = explode("\n", $text);

        foreach($lines as $line){
            echo $line . "<br>";
            if(preg_match_all('/^[(\ud83d\udd78)(\ud83c\udf35)(\ud83c\udf84)(\ud83c\udf32)(\ud83c\udf33)(\ud83c\udf34)(\ud83c\udf31)(\ud83c\udf3f)(\u2618\ufe0f)(\ud83c\udf40)(\ud83c\udf43)(\ud83c\udf42)(\ud83c\udf41)(\ud83c\udf44)(\ud83d\udd25)(\u26a1\ufe0f)(\ud83d\udca5)(\u2728)(\ud83c\udf08)(\u2744\ufe0f)(\ud83d\udca6)(\ud83d\udca8)(\ud83c\udf2c)(\ud83c\udf6d)(\ud83c\udf6c)(\ud83c\udf6b)(\ud83d\udcab)(\u2b50\ufe0f)(\ud83c\udf1f)]|[(\ud83d\udd78)(\ud83c\udf35)(\ud83c\udf84)(\ud83c\udf32)(\ud83c\udf33)(\ud83c\udf34)(\ud83c\udf31)(\ud83c\udf3f)(\u2618\ufe0f)(\ud83c\udf40)(\ud83c\udf43)(\ud83c\udf42)(\ud83c\udf41)(\ud83c\udf44)(\ud83d\udd25)(\u26a1\ufe0f)(\ud83d\udca5)(\u2728)(\ud83c\udf08)(\u2744\ufe0f)(\ud83d\udca6)(\ud83d\udca8)(\ud83c\udf2c)(\ud83c\udf6d)(\ud83c\udf6c)(\ud83c\udf6b)(\ud83d\udcab)(\u2b50\ufe0f)(\ud83c\udf1f)]$/', $line) > 0) return True;
        }

        return False;
    }

    echo emojiCheck($text) ? "Spam" : "Ok";
?>