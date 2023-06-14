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
        $viewname = 'lists/'.$fieldname.'.json';
        $this->response->setHeader('Content-type', 'application/json');
        return view($viewname);
    }
    public function auth()
    {
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
        }
        $this->response->setHeader('Content-type', 'application/json');
        return json_encode($return);

    }
}
