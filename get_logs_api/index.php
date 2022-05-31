<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AAAAA</title> <!-- Ну вот так вот прост -->
</head>
<body>
    <form action = "" method = "GET">
        <select name = "select" size = "10">
            <?php
                $dir = __DIR__ . '/logs/'; //Директария логов
                foreach( glob($dir . '*.log') as $file )
                {
                    $file_name = basename($file);
                    echo '<option>'.$file_name.'</option>';
                }
            ?>
        </select>
    </form>
<!--     <?php

        $index = 1; //Номер лога

        $logs = []; //Массив с логами

        //Переменные и проблемные ошибки
        $flag = false;
        $log_oAuthStackTraceError = 'League\OAuth2\Server\Exception\OAuthServerException';
        $log_oAuthStackTraceWarning = 'PDOException:';
        $log_arrayStack = 'array (';
        $log_debugError  = 'Debug\Exception\FatalErrorException';
        $log_null = '  ';
        $date_string = '';
        $type_string = '';
        $info_string = '';

        //Для каждого файла типа .log в директории $dir
        foreach (glob($dir . '*.log') as $file) 
        {
            $log_file_name = $dir.basename($file); //Имя файла с логом

            $f = fopen($log_file_name, "r"); //Открыть файл логов

            //Считывание всех строк в файле
            while ( ( $line = fgets($f) ) !== false )
            {
                //Флаг лога, все логи начинаются с '['
                if ($line[0] == '[') 
                {
                    $flag = true;
                    $date_index_end = strpos($line, ']');
                    $date_string = substr($line, 1, $date_index_end - 1);
                    $type_index_spacer = strpos($line, ':', $date_index_end);
                    $type_string = substr($line, $date_index_end + 2, $type_index_spacer - $date_index_end - 2);
                    $info_string = substr($line, $type_index_spacer + 2, strlen($line));
                    if ( ( str_contains($info_string, $log_oAuthStackTraceError) == true ) or (str_contains($info_string, $log_oAuthStackTraceWarning) == true ) or (str_contains($info_string, $log_arrayStack) == true ) or ( ($info_string[0] == ' ') and ($info_string[1] == ' ') ) or ( str_contains($info_string, $log_debugError) == true  ) ) //Если строка информации содержит указанные подстроки - продолжать запись лога 
                    {
                        $flag = false;
                    }
                } else 
                {
                    $flag = false;
                    $info_string = $info_string.$line;
                    if ( ( $line[0] == ')' ) or ( str_contains($info_string, '{main}') == true ) ) //Если строка содержит указанные подстроки - конец записи лога
                    {
                        $flag = true;
                    }
                }

                //По флагу добавляем в logs, ибо не в каждой строчке лог
                if ($flag == true) 
                {
                    $index = ['date' => $date_string, 'type' => $type_string, 'info' => $info_string];
                    array_push($logs, $index);
                }
            }
        }
        
        echo '<pre>';
        print_r($logs);
        echo '</pre>';
    ?> -->
</body>
</html>