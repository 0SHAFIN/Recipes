<?php
    require_once '../model/auth.php';
    session_start();
    $data=json_decode(file_get_contents("php://input"),true);
    switch($data['action'])
    {
        case 'signup':
            if(signup($data['name'],$data['phone'],$data['gender'],$data['username'],$data['password'])){
                http_response_code(200);
                $response=array(
                    'status' => 'success',
                );
                echo json_encode($response);
            }
            else{
                http_response_code(200);
                $response=array(
                    'status' => 'failed',
                );
                echo json_encode($response);
            }
            break;
        case 'login':
            if(signin($data['username'],$data['password'])){
                $result=getData($data['username']);
                $row=$result->fetch_assoc();
                $_SESSION['username']=$row['username'];
                $_SESSION['name']=$row['name'];
                $_SESSION['phone']=$row['phone'];
                $_SESSION['email']=$row['email'];
                $_SESSION['gender']=$row['gender'];
                $_SESSION['password']=$row['password'];
                $_SESSION['uId']=$row['uId'];
                http_response_code(200);
                $response=array(
                    'status' => 'success',
                );
                echo json_encode($response);
            }
            else{
                http_response_code(200);
                $response=array(
                    'status' => 'failed',
                );
                echo json_encode($response);
            }
            break;
        case 'update':
            if(updateData($data['field'],$data['value'],$_SESSION['username'],)){
                $_SESSION[$data['field']]=$data['value'];
                http_response_code(200);
                $response=array(
                    'status' => 'success',
                    'action' => $data['field'],
                    'value' => $data['value'],
                );
                $_SESSION[$data['field']]=$data['value'];
                echo json_encode($response);
            }
            else{
                http_response_code(200);
                $response=array(
                    'status' => 'failed',
                );
                echo json_encode($response);
            }
            break;
        case 'addRecipes':
            if(addRecipes($_SESSION['uId'],$data['reName'],$data['ingredients'],$data['description'],$data['category'],$_SESSION['name'],$data['time'])){
                http_response_code(200);
                $response=array(
                    'status' => 'success',
                );
                echo json_encode($response);
            }
            else{
                http_response_code(200);
                $response=array(
                    'status' => 'failed',
                );
                echo json_encode($response);
            }
            break;
    }


   
?>