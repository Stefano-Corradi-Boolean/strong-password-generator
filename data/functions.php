<?php
    
    function generatePassword($length, $allow_duplicates, $characters){

        $alphabet = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $symbols = '!?&%$<>^+-*/()[]{}@#_=';
        
        if(empty($length)){
            return 'Inserire un valore numerico';
        } elseif($length < 8 || $length > 32){
            return 'Il valore deve essere compreso fra gli 8 e i 32 caratteri';
        }


        // creo una stringa base per la generazione della psw
        $base_string = createBaseString($alphabet, $numbers, $symbols, $characters);

        
        // controllo che la lunghezza della psw non si più lunga dei numeri di caratteri disponibili
        $length = $length > strlen($base_string) ? strlen($base_string) : $length;

        // se la password non è valida la faccio ricenerare fino a quando non è valida
        do {
            $password = getPassword($base_string, $length, $allow_duplicates);
        } while (!checkPassword($password, $characters));



        // ripilisco la stringa dalla possibilità che generi dei tag
        $password = str_replace('<', '&lt;',$password);
        $password = str_replace('>', '&gt;',$password);

        session_start();
        $_SESSION['password'] = $password;
        header('Location: ./success.php');

    }

    function checkPassword($password, $characters){
        $lower = in_array('L', $characters) ? preg_match('/[a-z]/', $password) : true;
    
        $upper = in_array('L', $characters) ? preg_match('/[A-Z]/', $password) : true;
    
        $numbers = in_array('N', $characters) ? preg_match('/[0-9]/', $password) : true;
    
        $symbols = in_array('S', $characters) ? preg_match('/[^a-zA-Z0-9]/', $password) : true;

        return $lower && $upper && $numbers && $symbols;
    }
    

    function getPassword($base_string, $length, $allow_duplicates){
        $password = '';
        // estraggo un numero random in base alla lunghezza dei caratteri
        // concateno il carattere relativo a $password
        // ripeto l'operazione fino a quando la password non raggiunge la lunghezza desidersata

        while(strlen($password) < $length){
            $index = rand(0, strlen($base_string) - 1);
            $char = $base_string[$index];

            // filtro in caso non ci debbano essere i duplicati
            if($allow_duplicates || !str_contains($password,$char)){
                $password .= $char;
            }
            
        }


        return $password;
    }

    function createBaseString($alphabet, $numbers, $symbols, $characters){

        $fullCharacters = '';
        if(in_array('L', $characters)){
            $fullCharacters .= $alphabet .strtoupper($alphabet);
        }
        if(in_array('N', $characters)){
            $fullCharacters .= $numbers;
        }
        if(in_array('S', $characters)){
            $fullCharacters .= $symbols;
        }

        return $fullCharacters;
    }