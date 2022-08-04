<?php
    $text = $_POST['text'];

    function emojiCheck($text){
        $entries = preg_match_all('/[🕸🌵🎄🌲🌳🌴🌱🌿☘️🍀🍃🍂🍁🍄🔥⚡️💥✨🌈❄️💦💨🌬🍭🍬🍫💫⭐️🌟]/u', $text);

        if($entries > 1){
            return True;
        }

        $lines = explode("\n", $text);
        
        foreach($lines as $line){
            $entries = preg_match_all('/^[🕸🌵🎄🌲🌳🌴🌱🌿☘️🍀🍃🍂🍁🍄🔥⚡️💥✨🌈❄️💦💨🌬🍭🍬🍫💫⭐️🌟]|[🕸🌵🎄🌲🌳🌴🌱🌿☘️🍀🍃🍂🍁🍄🔥⚡️💥✨🌈❄️💦💨🌬🍭🍬🍫💫⭐️🌟]$/u', $line);

            if($entries > 0){
                return True;
            }
        }

        return False;
    }

    function cyrillicLatinMixChech($text){
        $entries = preg_match_all('/([А-Яа-яЁё][A-Za-z])|([A-Za-z][А-Яа-яЁё])/u', $text);

        if($entries > 0){
            return True;
        }

        return False;
    }

    function cyrillicWordsOverLatinWordsCheck($text){
        $cyrillicWords = preg_match_all('/(^| )[А-Яа-яЁё]/u', $text);
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
        echo preg_match_all('/[А-Яа-яЁёA-Za-z](к[аеиыо]|[аеиыо]чк[аеиыо]|[аеиыо]|[аеиыо]к|к[аеиыо]н|[аеиыо]ц[аеиыо])([^А-Яа-яЁёA-Za-z]|$)/u', $text, $matches) . "<br>";
        var_dump($matches);
    }

    echo (emojiCheck($text) || cyrillicLatinMixChech($text) || cyrillicWordsOverLatinWordsCheck($text)) ? "Spam" : "Ok";
?>