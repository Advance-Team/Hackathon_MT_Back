<?php

class API
{
    /** 
     * Данные для подключения к БД
     * 
     * [0] - Хост
     * 
     * [1] - Login
     * 
     * [2] - Password
     * 
     * [3] - Имя базы
     */
    private const sql_data = ["localhost", "admin", "admin", "hackathon"];

    /** 
     * Получение подключения к БД 
     * @return mysqli $conn Подключение к БД
     */
    private static function get_Connection()
    {
        $conn = mysqli_connect(self::sql_data[0], self::sql_data[1], self::sql_data[2], self::sql_data[3]);
        if (mysqli_connect_errno()) {
            echo "Не удалось подключится к базе данных MySQL: " . mysqli_connect_error();
        }
        return $conn;
    }

    public function login($email, $password)
    {
        $query = "SELECT `ApiKey` FROM `users` WHERE `email`='$email' and `password`='$password'";
        try {
            $result = mysqli_query(self::get_Connection(), $query);
            $rows = mysqli_num_rows($result);
            return $rows;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function register($email, $password){
        $key = implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
        $conn = self::get_Connection();
        try{
            mysqli_query($conn, "INSERT INTO `users` (`fio`, `PassData`, `INN`, `Phone`, `BIK`, `KPP`, `Korr`, `Rasch`, `ApiKey`, `Email`, `Password`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$key', '$email', '$password')");
            return "Success";
        }catch(\Throwable $th) {
            print_r($th);
            return 0;
        }
    }

    public function updateData($ApiKey ,$fio, $passData, $INN, $phone, $BIK, $KPP, $Korr, $Rasch){
        try {
            mysqli_query(self::get_Connection(), "UPDATE `users` SET (`fio` = '$fio', `PassData` = $passData, `INN` = $INN, `Phone` = '$phone', `BIK` = $BIK, `KPP` = $KPP, `Korr` = $Korr, `Rasch` = $Rasch WHERE `ApiKey` = $ApiKey)");
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public static function getUserInfo(string $ApiKey){
        try{
            $result = mysqli_query(self::get_Connection(), "SELECT * FROM `users` WHERE `ApiKey` = '$ApiKey'");
            mysqli_fetch_row($result);
            return($result);
        }catch(\Throwable $th){
            return 0;
        }
    }

    public function getTests(){
        try{
            $result = mysqli_query(self::get_Connection(), "SELECT (`TestID`, `Name`, `Desc`, `Img`) FROM `tests`");
            return mysqli_fetch_all($result);
        }catch(\Throwable $th){
            return 0;
        }
    }

    public function getTest(int $ItestID){
        try{
            $result = mysqli_query(self::get_Connection(), "SELECT (`Test`) FROM `tests`");
            return mysqli_fetch_row($result);
        }catch(\Throwable $tr){
            return 0;
        }
    }

    public static function getPoints(string $ApiKey){
        try{
            $result = mysqli_fetch_row(mysqli_query(self::get_Connection(), "SELECT `Points` FROM "));
        }catch(\Throwable $th){
            return 0;
        }
    }

    public function calcTestAnswers(int $testID, string $answers, string $ApiKey)
    {
        try{
            $result = mysqli_fetch_row(mysqli_query(self::get_Connection(), "SELECT (`RightAnswers`, `AllPoints`) FROM `tests` WHERE `TestID` = $testID"));
            $AllPoints = $result[1];
            $result = explode(";", $result[0]);
            $answers = explode(";", $answers);
            $i = 0;
            $right = 0;
            for ($i=0; $i < count($answers); $i++) { 
                if ($result[$i] == $right[$i]){
                    $right += 1;
                }
            }
            $points = self::getPoints($ApiKey) + ($right * 10);
            $result = mysqli_query(self::get_Connection(), "UPDATE `users` SET `points` = $points");

        }catch(\Throwable $tr){
            return 0;
        }
    }

    public function createDOC($ApiKey, $INN, $rs, $bik, $ks){
        $userData = self::getUserInfo($ApiKey);
        print_r($userData);

        
        // $rtf_content = file_get_contents('filepath/' . $_REQUEST['filename']);
        // $rtf_content = str_replace('{namecustomer}', $, $rtf_content);

        // file_put_contents('filepath' . "Договор.rtf", $rtf_content);

        // header('Content-Type: application/rtf');    //To download file in rtf format

        // header('Content-Description: File Transfer');
        // header("Content-Disposition: attachment; filename=\"" . basename("temp.rtf") . "\";");
        // header('Cache-Control: must-revalidate');
        // header('Pragma: public');
        // header('Content-Length: ' . filesize("/api/"."temp.rtf"));
        // ob_clean();
        // flush();
        // readfile("/api/"."temp.rtf");
    }
}
error_reporting(E_ERROR | E_PARSE);
