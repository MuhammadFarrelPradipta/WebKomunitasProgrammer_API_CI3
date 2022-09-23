<?php

class ModelBerita extends CI_Model
{

    public function getBerita($id = null)
    {
        if ($id === null) {
            return $this->db->get('berita')->result_array();
        } else {
            return $this->db->get_where('berita', ['Id_berita' => $id])->result_array();
        }
    }
}
