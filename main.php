<?php
    $text = mb_strtolower($_POST['text']);

    $wordlist = file_get_contents("./wordlist.txt");

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

    function wordlistCheck($text, $wordlist){
        $words = explode("\n", $wordlist);

        foreach($words as $word){
            if(strlen($word) > 6){
                echo $word . "\n";
                $matches = [];
                
                $entries = preg_match_all('/(к[аеиыо03@]|[аеиыо03@]чк[аеиыо03@]|[аеиыо03@]|[аеиыо03@]к|к[аеиыо03@]н|[аеиыо03@]ц[аеиыо03@]|[аеиыо03@]ньк[аеиыо03@])$/u', $word, $matches);

                if($entries > 0){
                    $toReplace = $matches[0][0];
                    $word = preg_replace("/$toReplace$/u", "(к[аеиыо03@]|[аеиыо03@]чк[аеиыо03@]|[аеиыо03@]|[аеиыо03@]к|к[аеиыо03@]н|[аеиыо03@]ц[аеиыо03@]|[аеиыо03@]ньк[аеиыо03@]|[^А-Яа-яЁёA-Za-z]*)$", $word);
                }else{
                    $word = preg_replace("/[я]*$/u", "(я|[аеиыо03@]к|ч[аеиыо03@]к|к[аеиыо03@]|[аеиыо03@]ньк[аеиыо03@]|[^А-Яа-яЁёA-Za-z]*)$", $word);
                }
            }

            $word = "/$word/u";

            $entries = preg_match_all($word, $text);

            if($entries > 0){
                echo $word . "\n";
                return True;
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

    function soupCheck($text, $wordlist){
        $soup = preg_replace('/[^А-Яа-яЁёA-Za-z0-9]/u', "", $text);
        echo $soup . "\n";

        return wordlistCheck($soup, $wordlist);
    }

    /*
    var_dump(emojiCheck($text));
    var_dump(cyrillicLatinMixChech($text));
    var_dump(cyrillicWordsOverLatinWordsCheck($text));
    var_dump(wordlistCheck($text));
    var_dump(digitsCheck($text));
    */

    echo soupCheck($text, $wordlist) ? "Spam" : "Ok";
    //echo (emojiCheck($text) || cyrillicLatinMixChech($text) || cyrillicWordsOverLatinWordsCheck($text) || wordlistCheck($text, $wordlist) || digitsCheck($text)) ? "Spam" : "Ok";
?>