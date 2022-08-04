<?php
    $text = mb_strtolower($_POST['text']);

    $wordlist = file_get_contents("./wordlist.txt");

    function emojiCheck($text){
        $emoji_array = ['🕸','🌵','🎄','🌲','🌳','🌴','🌱','🌿','☘️','🍀','🍃','🍂','🍁','🍄','🔥','⚡️','💥','✨','🌈','❄️','💦','💨','🌬','🍭','🍬','🍫','💫','⭐️','🌟'];
        foreach($emoji_array as $emoji){
            $entries = mb_substr_count($text, $emoji);
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
            if(mb_strlen($word) > 5){
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

        return wordlistCheck($soup, $wordlist);
    }

    function specialSymbolCheck($text){
        $entries = preg_match_all('/[~@#\$%\^&\*=\+\/\\\|<>\[\]{}]/', $text);

        if($entries > 4){
            return True;
        }

        return False;
    }

    /*
    var_dump(emojiCheck($text));
    var_dump(cyrillicLatinMixChech($text));
    var_dump(cyrillicWordsOverLatinWordsCheck($text));
    var_dump(wordlistCheck($text));
    var_dump(digitsCheck($text));
    var_dump(soupCheck($text, $wordlist));
    var_dump(specialSymbolCheck($text));
    */

    echo (emojiCheck($text) || cyrillicLatinMixChech($text) || cyrillicWordsOverLatinWordsCheck($text) || wordlistCheck($text, $wordlist) || digitsCheck($text) || soupCheck($text, $wordlist) || specialSymbolCheck($text)) ? "Spam" : "Ok";
?>