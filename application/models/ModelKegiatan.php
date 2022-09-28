<?php

class ModelKegiatan extends CI_Model
{
    public function getKegiatan($id = null)
    {
        if ($id === null) {
            return $this->db->get('kegiatan')->result_array();
        } else {
            return $this->db->get_where('kegiatan', ['id_kegiatan' => $id])->result_array();
        }
    }
    public function deleteKegiatan($id = null)
    {
        $this->db->delete('kegiatan', ['id_kegiatan' => $id]);
        return $this->db->affected_rows();
    }
    public function createKegiatan($data)
    {
        $this->db->insert('kegiatan', $data);
        return $this->db->affected_rows();
    }
    public function updateKegiatan($data, $id)
    {
        $this->db->update('kegiatan', $data,  ['id_kegiatan' => $id]);
        return $this->db->affected_rows();
    }
}
