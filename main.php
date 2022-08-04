<?php
    $text = $_POST['text'];

    function emojiCheck($text){
        $emoji_array = ['🕸','🌵','🎄','🌲','🌳','🌴','🌱','🌿','☘️','🍀','🍃','🍂','🍁','🍄','🔥','⚡️','💥','✨','🌈','❄️','💦','💨','🌬','🍭','🍬','🍫','💫','⭐️','🌟'];

        foreach($emoji_array as $emoji){
            $entries = substr_count($text, $emoji);
            if($entries > 1){
                return True;
            }
        }

        $lines = explode("\n", $text);
        
        foreach($lines as $line){
            foreach($emoji_array as $emoji){
                if(str_starts_with($line, $emoji) || str_ends_with($line, $emoji)){
                    return True;
                }
            }
        }

        return False;
    }

    function cyryllicLatinMixChech($text){
        $entries = preg_match_all('/([А-Яа-яЁё][A-Za-z])|([A-Za-z][А-Яа-яЁё])/', $text);
        var_dump($entries);
        if($entries > 0){
            return True;
        }

        return False;
    }

    echo (emojiCheck($text) && cyryllicLatinMixChech($text)) ? "Spam" : "Ok";
?>