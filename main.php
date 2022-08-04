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

    function cyrillicLatinMixChech($text){
        $entries = preg_match_all('/([А-Яа-яЁё][A-Za-z])|([A-Za-z][А-Яа-яЁё])/', $text);

        if($entries > 0){
            return True;
        }

        return False;
    }

    function cyrillicWordsOverLatinWordsCheck($text){
        $cyrillicWords = preg_match_all('/(^| )[А-Яа-яЁё]/', $text);
        $latinWords = preg_match_all('/(^| )[A-Za-z]/', $text);

        if($cyrillicWords <= $latinWords){
            return True;
        }

        return False;
    }

    function wordlistCheck($text){
        $wordlist = file_get_contents("./wordlist.txt");
        $words = explode("\n", $wordlist);

        foreach($words as $word){
            //$preg_word = 
        }
    }

    function testFunction($text){
        $matches = [];
        echo preg_match_all('/[А-Яа-яЁёA-Za-z](к[аеиыо]|[аеиыо]чк[аеиыо]|[аеиыо]|[аеиыо]к|к[аеиыо]н|[аеиыо]ц[аеиыо])([^А-Яа-яЁёA-Za-z]|$)/', $text, $matches) . "<br>";
        var_dump($matches);
    }

    testFunction($text);
    //echo (emojiCheck($text) || cyrillicLatinMixChech($text) || cyrillicWordsOverLatinWordsCheck($text)) ? "Spam" : "Ok";
?>