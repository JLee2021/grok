<?php

namespace App\Models;

use CodeIgniter\Model;

class DropdownModel extends Model
{
    private function get_options_via_curl($fieldname, $token)
    {
        $ch = curl_init('https://nefsctest.nmfs.local/grok/html/Backend/public/index.php/api/select_options/'.$fieldname);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'X-API-TOKEN:'.$token));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        $apiResponse = curl_exec($ch);
        curl_close($ch);

        return json_decode($apiResponse);
    }

    public function get_values($fieldname, $token)
    {
        return $this->get_options_via_curl($fieldname, $token);
    }
}
