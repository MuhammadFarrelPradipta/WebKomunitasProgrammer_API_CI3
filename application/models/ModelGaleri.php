<?php

class ModelGaleri extends CI_Model
{
    public function getGaleri($id = null)
    {
        if ($id === null) {
            return $this->db->get('galeri')->result_array();
        } else {
            return $this->db->get_where('galeri', ['Id_foto' => $id])->result_array();
        }
    }
    public function deleteGaleri($id = null)
    {
        $this->db->delete('galeri', ['Id_foto' => $id]);
        return $this->db->affected_rows();
    }
    public function createGaleri($data)
    {
        $this->db->insert('galeri', $data);
        return $this->db->affected_rows();
    }
    public function updateGaleri($data, $id)
    {
        $this->db->update('galeri', $data,  ['Id_foto' => $id]);
        return $this->db->affected_rows();
    }
}
