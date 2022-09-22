<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

class Galeri extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelGaleri');
    }
    public function index_get()
    {

        $id = $this->get('Id_foto');
        if ($id === null) {
            $galeri = $this->ModelGaleri->getGaleri();
        } else {
            $galeri = $this->ModelGaleri->getGaleri($id);
        }

        if ($galeri) {
            $this->response([
                'status' => true,
                'data' => $galeri
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'messages' => 'Id Not Found'
            ], RestController::HTTP_NOT_FOUND);
        }
    }
    public function index_delete()
    {
        $id = $this->delete('Id_foto');
        if ($id === null) {
            $this->response([
                'status' => false,
                'messages' => 'Provide Id'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->ModelGaleri->deleteGaleri($id) > 0) {
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
    public function index_post()
    {
        $data = [
            'Nama_foto' => $this->post('Nama_foto'),
            'Deskripsi_foto' => $this->post('Deskripsi_foto'),
            'Foto' => $this->post('Foto')
        ];
        if ($this->ModelGaleri->createGaleri($data) > 0) {
            $this->response([
                'status' => true,
                'messages' => 'new galeri data has been created'
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'messages' => 'new galeri data failed'
            ], RestController::HTTP_NOT_ACCEPTABLE);
        }
    }
    public function index_put()
    {
        $id = $this->put('Id_foto');
        $data = [
            'Nama_foto' => $this->put('Nama_foto'),
            'Deskripsi_foto' => $this->put('Deskripsi_foto'),
            'Foto' => $this->put('Foto')
        ];
        if ($this->ModelGaleri->updateGaleri($data, $id) > 0) {
            $this->response([
                'status' => true,
                'messages' => 'new galeri data has been updated'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'messages' => 'failed to update'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
