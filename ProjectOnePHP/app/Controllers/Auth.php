<?php

namespace App\Controllers;

class Auth extends BaseController
{

    private function authenticate_via_curl($postRequest)
    {
        $ch = curl_init('https://nefsctest.nmfs.local/grok/html/Backend/public/index.php/api/auth');
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postRequest);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        $apiResponse = curl_exec($ch);
        curl_close($ch);

        return json_decode($apiResponse);
    }
    public function index()
    {
        $session = session();

        $return = new \stdClass;
        $return->error = TRUE;
        $return->authenticated = FALSE;
        $post_arr = $this->request->getPost();

        $return = $this->authenticate_via_curl(json_encode($post_arr));

        if($return && $return->authenticated)
        {
            //$return->error = FALSE;
            //$return->authenticated = TRUE;
            //$return->username = $username;
            //helper('text');
            //$return->token = random_string('alnum', 40);
            $session->set('token',$return->token);
            return redirect()->to('home/dashboard');
        }else {
            $session->set('auth_msg','not authorized');
            return redirect()->to('/');
        }

        //$this->response->setHeader('Content-type', 'application/json');
        //return json_encode($return);

    }


}
