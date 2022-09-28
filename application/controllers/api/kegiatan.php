<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

class Kegiatan extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelKegiatan');
    }

    public function index_get()
    {
        $id = $this->get('Id_kegiatan');
        if ($id === null) {
            $kegiatan = $this->ModelKegiatan->getKegiatan();
        } else {
            $kegiatan = $this->ModelKegiatan->getKegiatan($id);
        }
        if ($kegiatan) {
            $this->response([
                'status' => true,
                'data' => $kegiatan
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
            'nama_kegiatan' => $this->post('nama_kegiatan'),
            'logo_kegiatan' => $this->post('logo_kegiatan'),
            'isi_kegiatan' => $this->post('isi_kegiatan')
        ];
        if ($this->ModelKegiatan->createKegiatan($data) > 0) {
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
        $id = $this->put('id_kegiatan');
        $data = [
            'nama_kegiatan' => $this->put('nama_kegiatan'),
            'logo_kegiatan' => $this->put('logo_kegiatan'),
            'isi_kegiatan' => $this->put('isi_kegiatan')
        ];
        if ($this->ModelKegiatan->updateKegiatan($data, $id) > 0) {
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
        $id = $this->delete('id_kegiatan');
        if ($id === null) {
            $this->response([
                'status' => false,
                'messages' => 'Provide Id'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->ModelKegiatan->deleteKegiatan($id) > 0) {
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
