<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_admin extends CI_Model
{


    public function getList_role()
    {
        $this->db->select('*');
        $this->db->from('user_role');
        $result = $this->db->get();
        return $result->result();
    }

    // Account   ==================
    public function getList_account()
    {
        $this->db->select('id, image, name, email, role_id, is_active');
        $this->db->from('user');
        $result = $this->db->get();
        return $result->result();
    }

    // Daftar Pengguna
    public function getList_akun($id)
    {
        $this->db->select('id, name, email, image, role_id, is_active');
        $this->db->from('user');
        $this->db->where('id', $id);
        $result = $this->db->get();
        return $result->row_array();
    }

    // Diagnosa =================
    public function getList_diagnosa()
    {
        if ($this->input->post('id')) {
            $this->db->where('id', $this->input->post('id'));
        }
        $this->db->select('id, kode, nama, keterangan');
        $this->db->order_by('kode', 'desc');
        $this->db->from('diagnosa');
        $result = $this->db->get();
        return $result->result();
    }

    // Gejala =================
    public function getList_gejala()
    {
        if ($this->input->post('id')) {
            $this->db->where('id', $this->input->post('id'));
        }
        $this->db->select('id, kode, nama, keterangan');
        $this->db->order_by('kode', 'desc');
        $this->db->from('gejala');
        $result = $this->db->get();
        return $result->result();
    }


    // Relasi =================
    public function getList_relasi()
    {
        if ($this->input->post('id')) {
            $this->db->where('a.id', $this->input->post('id'));
        }
        $this->db->select('a.id as relasi_id, b.id as diagnosa_id, c.id as gejala_id, b.nama as diagnosa_nama, c.nama as gejala_nama, a.md as md, a.mb as mb');
        $this->db->from('relasi a');
        $this->db->join('diagnosa b', 'a.diagnosa_id = b.id');
        $this->db->join('gejala c', 'a.gejala_id = c.id');
        $query = $this->db->get();
        return $query->result();
    }
}
