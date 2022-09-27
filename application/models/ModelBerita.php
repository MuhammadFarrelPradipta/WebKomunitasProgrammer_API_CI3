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
    public function createBerita($data)
    {
        $this->db->insert('berita', $data);
        return $this->db->affected_rows();
    }
    public function updateBerita($data, $id)
    {
        $this->db->update('berita', $data, ['Id_berita' => $id]);
        return $this->db->affected_rows();
    }
    public function deleteBerita($id = null)
    {
        $this->db->delete('berita', ['Id_berita' => $id]);
        return $this->db->affected_rows();
    }
}
