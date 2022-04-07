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


            $key = $this->getKey($_POST['first_name'], $_POST['last_name']);

            $data = [

                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'age' => $_POST['age'],
                'profession' => $_POST['profession'],
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

            $retourClient["seccess"] = true;
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
