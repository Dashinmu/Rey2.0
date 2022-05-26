<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DEMO-API</title>
    </head>
    <body>
        <?php

            function oauth () {
                $url_api_oauth = 'https://taxi-demo.intermobility.ru/tpapi/oauth/token';

                $userid = 'tp_78';
                $clientid = '16455';
                $password = 'qsigezc4qiysp0rc';

                $oauth_header = array (
                    'Content-Type: application/x-www-form-urlencoded'
                );

                $oauth_data = 'grant_type=client_credentials';

                $ch = curl_init($url_api_oauth);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($ch, CURLOPT_USERPWD, $userid . '/' . $clientid . ':' . $password);
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($ch, CURLOPT_POSTFIELDS, $oauth_data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $oauth_header);
                $key = curl_exec($ch);
                curl_close($ch);          

                $file_json = 'oath_key.json';
                $result_json = json_encode($key);
                file_put_contents($file_json, $result_json);

                echo 'access key generated!<br>';
            }

            function query () {
                $url_api = 'https://taxi-demo.intermobility.ru/tpapi/';

                $access_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE2NTM1NTY1NTgsImV4cCI6MTY1MzU2MDE1OCwic3ViIjoidHBfNzgiLCJvaWQiOjc4LCJlaWQiOjE2NDU1LCJldHlwIjoiT1BFUkFUT1IiLCJyb2wiOlsiQUNDUkVESVRfT1JHUyIsIkVESVRfRU1QTE9ZRUVTIiwiRURJVF9WRUhJQ0xFUyIsIkxJU1RfRFJJVkVSUyIsIkxJU1RfRU1QTE9ZRUVTIiwiTElTVF9OT1RJRklDQVRJT05TIiwiTElTVF9UUlVTVEVEX09SR1MiLCJMSVNUX1ZFSElDTEVTIiwiTElTVF9XQVlCSUxMUyIsIk1PRElGWV9FTVBMT1lFRVMiLCJNT0RJRllfVkVISUNMRVMiLCJNT0RJRllfV0FZQklMTFMiLCJSRUFEX1JPTEVTIiwiUk9MRV9FTVBMT1lFRV9BRE1JTiIsIlJPTEVfT1JHX1BST0ZJTEVfVklFV0VSIiwiUk9MRV9UQVhJUEFSS19PUEVSQVRPUiIsIlJPTEVfVkVISUNMRV9FRElUT1IiLCJST0xFX1dBWUJJTExfSVNTVUVSIiwiVklFV19FTVBMT1lFRVMiLCJWSUVXX0hFTFAiLCJWSUVXX09SR1MiLCJWSUVXX09SR19QUk9GSUxFIiwiVklFV19WRUhJQ0xFUyIsIlZJRVdfV0FZQklMTFMiXX0.rIVwK3MGA0Xx9zZevWI5EfkSNDL8ue7n8GstqBgEZnmHRRr1tf5N6wIlsoyuumYgJ-Q038BcjvRFgecSGCfUeg';
                //Токен доступа взять из oath_key.json
                $api_headers = array (
                    'Authorization: Bearer '. $access_token,
                    'content-type: application/json',
                    'accept: */*'
                );

                $api_data = 'pageNum=1&pageSize=10'; //Указать запрос

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                curl_setopt($ch, CURLOPT_URL, $url_api.'vehicles?');
                curl_setopt($ch, CURLOPT_POSTFIELDS, $api_data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $api_headers);
                $response = curl_exec($ch);
                curl_close($ch);

                $file_html = 'response.html';
                file_put_contents($file_html, $response);

                echo 'query success generated!';
            }
            
            if (isset($_POST["oAuth"])) { 
                oauth(); 
            }

            if (isset($_POST["Query"])) {
                query();
            }

        ?>

        <form method = "post">
            <input type = "submit" name = "oAuth" value = "oAuth">
            <input type = "submit" name = "Query" value = "Query">
        </form>

    </body>
</html>