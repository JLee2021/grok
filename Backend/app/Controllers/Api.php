<?php

namespace App\Controllers;

class Api extends BaseController
{

    public function index()
    {
        return view('welcome_message');
    }

    public function select_options($fieldname)
    {
        $this->session = \Config\Services::session();
        $token = $this->session->token;
        $headers = getallheaders();
        $request_token = $headers['X-API-TOKEN'];
        $this->response->setHeader('Content-type', 'application/json');
        if((isset($token))&&(isset($request_token))&&($token==$request_token))
        {
            $viewname = 'lists/'.$fieldname.'.json';
            $this->response->setStatusCode(200);
            return view($viewname);
        }else {
          $data = array('error' => TRUE, 'message' => 'not authorized'); //, 'token' => $token, 'headers' => $this->request->headers(), 'all_headers' => getallheaders());
          return $this->response->setJSON($data);
        }
    }
    public function auth()
    {
        $session = session();

        $return = new \stdClass;
        $return->error = TRUE;
        $return->authenticated = FALSE;
        $email = $this->request->getPostGet('email');
        $password = $this->request->getPostGet('password');
        $username = str_replace("@noaa.gov","",strtolower($email));
        $ldapconn = ldap_connect("ldaps://whitepages.noaa.gov") or die("Could not connect");
        $ldapbind = @ldap_bind($ldapconn, "uid=".($username).",ou=people,dc=noaa,dc=gov", $password);
        if($ldapbind)
        {
            ldap_unbind($ldapconn);
            $return->error = FALSE;
            $return->authenticated = TRUE;
            $return->username = $username;
            helper('text');
            $return->token = random_string('alnum', 40);
            $session->set('token',$return->token);
        }
        $return->session = $_SESSION;
        $this->response->setHeader('Content-type', 'application/json');
        return json_encode($return);

    }
}
