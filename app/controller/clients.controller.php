<?php
class clients extends controller
{

    public function __construct()
    {
        $this->clientModel = $this->model('client');
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
    }

    public function addClient()
    {

        header('Acces-Control-Allow-Methods: POST');
        header('Acces-Control-Allow-Headers: Acces-Control-Allow-Methods,Content-Type,Acces-Control-Allow-Headers,Authorization,X-Requested-With');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $info =json_decode(file_get_contents("php://input"));

            $key = $this->getKey($info->first_name, $info->last_name);

            $data = [

                'first_name' => $info->first_name,
                'last_name' => $info->last_name,
                'age' => $info->age,
                'profession' => $info->profession,
                'key' => $key
            ];

            $client = $this->clientModel->add_client($data);
            if ($client) {

                $retourClient["seccess"] = true;
                $retourClient['key'] = $key;
                echo json_encode($retourClient);
            } else {
                die("add_err");
            }
        } else {

            $retourClient["seccess"] = false;
            echo json_encode($retourClient);
        }
    }

    public function getKey($fName, $lName)
    {

        $arr1 = str_split($fName);
        $arr2 = str_split($lName);
        $key = $arr1[0] . $arr1[2] . rand(123, 999) . $arr2[0] . $arr2[2] . rand(123, 999);
        return $key;
    }
}
