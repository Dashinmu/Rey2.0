<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AAAAA</title> <!-- Ну вот так вот прост -->
</head>
<body>
    <?php
        $dir = __DIR__ . '/logs/'; //Директария логов
    
        $index = 0; //Номер лога

        $logs = []; //Массив с логами

        //Переменные для позиционирования, для вывода
        //$date_index_begin = 0;
        $flag = false;
        $date_string = '';
        $type_string = '';
        $info_string = '';
        //$date_index_end = 0;
        //$type_index_spacer = 0;
        //$lenght_string = 0;

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
                } else 
                {
                    $flag = false;
                }

                //По флагу добавляем в logs, ибо не в каждой строчке лог
                if ($flag == true) 
                {
                    $index = ['date' => $date_string, 'type' => $type_string, 'info' => $info_string];
                    array_push($logs, $index);
                }

                //Условие для вывода лога, ибо все логи начинаются с '[', иначе просто добавление информации в строку info
                if ($flag == true) 
                {
                    //$flag = true;
                    $date_index_end = strpos($line, ']');
                    $date_string = substr($line, 1, $date_index_end - 1);
                    $type_index_spacer = strpos($line, ':', $date_index_end);
                    $type_string = substr($line, $date_index_end + 2, $type_index_spacer - $date_index_end - 2);
                    $info_string = substr($line, $type_index_spacer + 2, strlen($line));
                } else 
                {
                    //$flag = false;
                    $info_string = $info_string.$line;
                }
            }
        }
        
        echo '<pre>';
        print_r($logs);
        echo '</pre>';
    ?>
</body>
</html>