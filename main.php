<?php
    $text = strtolower($_POST['text']);

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
                
                $entries = preg_match_all('/(к[аеиыо]|[аеиыо]чк[аеиыо]|[аеиыо]|[аеиыо]к|к[аеиыо]н|[аеиыо]ц[аеиыо]|[аеиыо]ньк[аеиыо])$/u', $word, $matches);

                if($entries > 0){
                    $toReplace = $matches[0][0];
                    $word = preg_replace("/$toReplace$/u", "(к[аеиыо]|[аеиыо]чк[аеиыо]|[аеиыо]|[аеиыо]к|к[аеиыо]н|[аеиыо]ц[аеиыо]|[аеиыо]ньк[аеиыо])", $word);
                }else{
                    $word = preg_replace("/[я]*$/u", "(я|[аеиыо]к|ч[аеиыо]к|к[аеиыо]|[аеиыо]ньк[аеиыо])", $word);
                }
            }

            $word = "/$word/u";

            //echo $word . "\n";
            $entries = preg_match_all($word, $text);

            if($entries > 0){
                return True;
            }
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
    echo wordlistCheck($text) ? "Spam" : "Ok";
    //echo (emojiCheck($text) || cyrillicLatinMixChech($text) || cyrillicWordsOverLatinWordsCheck($text)) ? "Spam" : "Ok";
?>