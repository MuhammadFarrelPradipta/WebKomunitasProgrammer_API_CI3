<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

class Berita extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelBerita');
    }

    public function index_get()
    {
        $id = $this->get('Id_berita');
        if ($id === null) {
            $berita = $this->ModelBerita->getBerita();
        } else {
            $berita = $this->ModelBerita->getBerita($id);
        }
        if ($berita) {
            $this->response([
                'status' => true,
                'data' => $berita
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'messages' => 'Id Not Found'
            ], RestController::HTTP_NOT_FOUND);
        }
    }
}
