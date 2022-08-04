<?php
    $text = mb_strtolower($_POST['text']);

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
                
                $entries = preg_match_all('/(к[аеиыо03@]|[аеиыо03@]чк[аеиыо03@]|[аеиыо03@]|[аеиыо03@]к|к[аеиыо03@]н|[аеиыо03@]ц[аеиыо03@]|[аеиыо03@]ньк[аеиыо03@])$/u', $word, $matches);

                if($entries > 0){
                    $toReplace = $matches[0][0];
                    $word = preg_replace("/$toReplace$/u", "(к[аеиыо03@]|[аеиыо03@]чк[аеиыо03@]|[аеиыо03@]|[аеиыо03@]к|к[аеиыо03@]н|[аеиыо03@]ц[аеиыо03@]|[аеиыо03@]ньк[аеиыо03@])", $word);
                }else{
                    $word = preg_replace("/[я]*$/u", "(я|[аеиыо03@]к|ч[аеиыо03@]к|к[аеиыо03@]|[аеиыо03@]ньк[аеиыо03@])", $word);
                }
            }

            $word = "/$word/u";

            $entries = preg_match_all($word, $text);

            if($entries > 0){
                return True;
            }else{
                echo $word . "\n";
            }
        }

        return False;
    }

    function digitsCheck($text){
        $entries = preg_match_all('/[А-Яа-яЁёA-Za-z]+[0-9]|[0-9][А-Яа-яЁёA-Za-z-]{4,}/u', $text);

        if($entries > 0){
            return True;
        }

        return False;
    }

    function testFunction($text){
        $text = str_replace("\n", " ", $text);
        $words = explode(" ", $text);
        echo implode("<br>", $words);

        //echo preg_match_all('/к[аеиыо]|[аеиыо]чк[аеиыо]|[аеиыо]|[аеиыо]к|к[аеиыо]н|[аеиыо]ц[аеиыо]/u', $text, $matches) . "<br>";
        //var_dump($matches);
    }

    var_dump(emojiCheck($text));
    var_dump(cyrillicLatinMixChech($text));
    var_dump(cyrillicWordsOverLatinWordsCheck($text));
    var_dump(wordlistCheck($text));
    var_dump(digitsCheck($text));

    echo (emojiCheck($text) || cyrillicLatinMixChech($text) || cyrillicWordsOverLatinWordsCheck($text) || wordlistCheck($text) || digitsCheck($text)) ? "Spam" : "Ok";
?>