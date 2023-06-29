<?php

namespace App\Models;

class BoatModel extends \CodeIgniter\Model
{
    protected $file = 'boats.csv';

    protected $allowedFields = [
        'id', 'name'
      ];

      public function read_file($file){
        $arrContextOptions = array(
            "ssl" => array(
              "verify_peer" => false,
              "verify_peer_name" => false,
            ),
          );
          $file = file_get_contents($file, false, stream_context_create($arrContextOptions));
          return explode(",", $file);
      }
}