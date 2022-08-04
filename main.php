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
            if(strlen($word > 4)){
                $matches = [];
                preg_match_all('/к[аеиыо]|[аеиыо]чк[аеиыо]|[аеиыо]|[аеиыо]к|к[аеиыо]н|[аеиыо]ц[аеиыо]/u', $word, $matches);

                $toReplace = $matches[1];
                $word = str_replace($toReplace, "(к[аеиыо]|[аеиыо]чк[аеиыо]|[аеиыо]|[аеиыо]к|к[аеиыо]н|[аеиыо]ц[аеиыо])", $word);
            }

            $word = "/$word/u";
            
            echo $word . "\n";
        }
    }

    function testFunction($text){
        $text = str_replace("\n", " ", strtolower($text));
        $words = explode(" ", $text);
        echo implode("<br>", $words);

        //echo preg_match_all('/к[аеиыо]|[аеиыо]чк[аеиыо]|[аеиыо]|[аеиыо]к|к[аеиыо]н|[аеиыо]ц[аеиыо]/u', $text, $matches) . "<br>";
        //var_dump($matches);
    }
    wordlistCheck($text);
    //echo (emojiCheck($text) || cyrillicLatinMixChech($text) || cyrillicWordsOverLatinWordsCheck($text)) ? "Spam" : "Ok";
?>