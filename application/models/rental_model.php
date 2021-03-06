<?php
defined('BASEPATH') or exit('No direct script access allowed');

class rental_model extends CI_model
{
    public function getDataMobil()
    {
        return $this->db->get('mobil')->result_array();
    }

    public function getDataMobilById($id_mobil)
    {
        return $this->db->get_where('mobil', ['id_mobil' => $id_mobil])->row_array();
    }

    public function tambahDataMobil()
    {
        $data = [
            'kode_type' => $this->input->post('kode_type'),
            'merk' => htmlspecialchars($this->input->post('merk', true)),
            'no_plat' => htmlspecialchars($this->input->post('no_plat', true)),
            'warna' => htmlspecialchars($this->input->post('warna', true)),
            'tahun' => htmlspecialchars($this->input->post('tahun', true)),
            'status' => $this->input->post('status'),
            'gambar' => $this->_uploadGambar()
        ];

        $this->db->insert('mobil', $data);
    }

    private function _uploadGambar()
    {
        $config['upload_path']          = './assets/img/imgcar/';
        $config['allowed_types']        = 'jpeg|jpg|png|gif';
        $config['max_size']             = '5000';

        $this->upload->initialize($config);

        if ($this->upload->do_upload('gambar')) {
            return $this->upload->data('file_name');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('admin/Data_mobil');
        }
    }

    public function hapusDataMobil($id_mobil)
    {
        $this->db->where('id_mobil', $id_mobil);
        $this->db->delete('mobil');
    }

    public function ubahDataMobil()
    {
        $data = [
            'kode_type' => $this->input->post('kode_type'),
            'merk' => $this->input->post('merk'),
            'no_plat' => $this->input->post('no_plat'),
            'warna' => $this->input->post('warna'),
            'tahun' => $this->input->post('tahun'),
            'status' => $this->input->post('status'),
            'gambar' => $this->_ubahUploadGambar()
        ];

        $this->db->where('id_mobil', $this->input->post('id_mobil'));
        $this->db->update('mobil', $data);
    }

    private function _ubahUploadGambar()
    {
        if (empty($_FILES['gambar']['name'])) {
            $gambar = $this->input->post('gambarLama');
        } else {
            $gambar = $this->_uploadGambar();
        }

        return $gambar;
    }

    public function getDataType()
    {
        return $this->db->get('type')->result_array();
    }

    public function getDataTypeById($id_type)
    {
        return $this->db->get_where('type', ['id_type' => $id_type])->row_array();
    }

    public function tambahDataType()
    {
        $data = [
            'kode_type' => htmlspecialchars($this->input->post('kode_type', true)),
            'nama_type' => htmlspecialchars($this->input->post('nama_type', true))
        ];

        $this->db->insert('type', $data);
    }

    public function hapusDataType($id)
    {
        $this->db->where('id_type', $id);
        $this->db->delete('type');
    }

    public function ubahDataType()
    {
        $data = [
            'kode_type' => htmlspecialchars($this->input->post('kode_type', true)),
            'nama_type' => htmlspecialchars($this->input->post('nama_type', true))
        ];

        $this->db->where('id_type', $this->input->post('id_type'));
        $this->db->update('type', $data);
    }


    public function getDataCustomer()
    {
        return $this->db->get('customer')->result_array();
    }

    public function getDataCustomerById($id)
    {
        return $this->db->get_where('customer', ['id_customer' => $id])->row_array();
    }

    public function tambahDataCustomer()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'username' => htmlspecialchars($this->input->post('username', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat', true)),
            'gender' => htmlspecialchars($this->input->post('gender', true)),
            'no_telepon' => htmlspecialchars($this->input->post('no_telepon', true)),
            'no_ktp' => htmlspecialchars($this->input->post('no_ktp', true)),
            'password' => password_hash($this->input->post('no_ktp'), PASSWORD_DEFAULT)
        ];

        $this->db->insert('customer', $data);
    }

    public function hapusCustomer($id)
    {
        $this->db->delete('customer', ['id_customer' => $id]);
    }

    public function ubahDataCustomer()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'username' => htmlspecialchars($this->input->post('username', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat', true)),
            'gender' => htmlspecialchars($this->input->post('gender', true)),
            'no_telepon' => htmlspecialchars($this->input->post('no_telepon', true)),
            'no_ktp' => htmlspecialchars($this->input->post('no_ktp', true)),
            'password' => password_hash($this->input->post('no_ktp'), PASSWORD_DEFAULT)
        ];

        $this->db->where('id_customer', $this->input->post('id_customer'));
        $this->db->update('customer', $data);
    }
}
