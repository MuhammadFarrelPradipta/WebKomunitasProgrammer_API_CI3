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
    public function index_post()
    {
        $data = [
            'Judul_berita' => $this->post('Judul_berita'),
            'Foto_berita' => $this->post('Foto_berita'),
            'Deskripsi_berita' => $this->post('Deskripsi_berita'),
            'Tanggal_berita' => $this->post('Tanggal_berita')
        ];
        if ($this->ModelBerita->createBerita($data) > 0) {
            $this->response([
                'status' => true,
                'messages' => 'new berita data has been created'
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'messages' => 'new berita data failed'
            ], RestController::HTTP_NOT_ACCEPTABLE);
        }
    }
    public function index_put()
    {
        $id = $this->put('Id_berita');
        $data = [
            'Judul_berita' => $this->put('Judul_berita'),
            'Foto_berita' => $this->put('Foto_berita'),
            'Deskripsi_berita' => $this->put('Deskripsi_berita'),
            'Tanggal_berita' => $this->put('Tanggal_berita')
        ];
        if ($this->ModelBerita->updateBerita($data, $id) > 0) {
            $this->response([
                'status' => true,
                'messages' => 'new berita data has been updated'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'messages' => 'failed to update'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
    public function index_delete()
    {
        $id = $this->delete('Id_berita');
        if ($id === null) {
            $this->response([
                'status' => false,
                'messages' => 'Provide Id'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->ModelBerita->deleteBerita($id) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'messages' => 'deleted'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'messages' => 'Id Not Found'
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }
}
