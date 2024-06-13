<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . '/vendor/autoload.php';

class Services extends CI_Controller {
    function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

		// $this->load->model('m_data');
		$this->load->model('user_model');
		$this->load->library('pdf');
	}

    //HTTP POST
    public function client_login()
	{		
        //API fetch JSON from client
        $this->input->raw_input_stream;
        $request = json_decode($this->input->raw_input_stream, true);
        $username = $request['username'];
        $password = md5($request['password']);
        $app_name = $request['app_name'];

        //$app_id = $this->db->query

		$where = array(
			'user_username' => $username,
			'user_password' => $password
		);

		// $this->load->model('m_data');
		// $cek = $this->m_data->cek_login('user',$where)->num_rows();
		// if($cek > 0){				
        $data = $this->user_model->do_login($username, $request['password']);
        if(!empty($data)){
			// $data = $this->m_data->cek_login('user',$where)->row();
            $pegawai_id = $data->pegawai_id;

            $kariers = $this->db->select('*')
					->from('pegawai_karir as t1')
					->where('t1.pegawai_id', $pegawai_id)
					->where('t1.is_active', TRUE)
					->join('master_pegawai_status as t3', 't1.status_pegawai_id = t3.status_pegawai_id', 'LEFT')
					->join('deputi as t4', 't1.deputi_id = t4.deputi_id', 'LEFT')
					->join('divisi as t5', 't1.divisi_id = t5.divisi_id', 'LEFT')
                    ->join('divisi_bagian as t6', 't1.divisi_bagian_id = t6.divisi_bagian_id', 'LEFT')
                    ->join('master_jabatan as t7', 't1.jabatan_id = t7.jabatan_id', 'LEFT')
                    ->join('master_pegawai_level as t8', 't1.level_id = t8.level_id', 'LEFT')
					->get()
					->result();
            
            $token = "a6917782b6961e9782fe4bec3d7a5557";

            if (empty($app_name)) {
                $resp = [
                    'response' => [
                        'user_id' => $data->user_id,
                        'user_nama' => $data->user_nama,
                        'user_username' => $data->user_username,
                        // 'user_akses' => 'Not Allowed',
                        // 'app_role' => '',
                        //'app_id' => '',
                        'pegawai_id' => $data->pegawai_id,
                        // 'pegawai_level' => array(),
                        //'pegawai_divisi' => array(),
                        // 'pegawai_divisi_bagian' => array(),
                        'karier' => $kariers,
                        'foto_path' => $data->foto_path,
                        'token'=> $token  
                    ],
                    'metadata' => [
                                    'message' => 'OK',
                                    'code'    => 200
                    ]
                ];
        
                //Hilangkan data yang tidak perlu
                foreach ($kariers as $i => $karier) {
                    unset($resp['response']['karier'][$i]->created_at);
                    unset($resp['response']['karier'][$i]->edited_at);
                    unset($resp['response']['karier'][$i]->deleted_at);
                    unset($resp['response']['karier'][$i]->created_by);
                    unset($resp['response']['karier'][$i]->edited_by);
                    unset($resp['response']['karier'][$i]->deleted_by);
                    unset($resp['response']['karier'][$i]->is_active);
                }

                //$response = array_values($resp);

            }else{

                $apps = $this->db->query("SELECT * FROM apps WHERE apps_nama = '$app_name'")->row();
                
                if (empty($apps)) {

                    $resp = [
                        'response' => "Aplikasi tidak ditemukan!",
                        'metadata' => [
                                        'message' => 'Error',
                                        'code'    => 402
                        ]
                    ];

                }else {

                    $akses = $this->db->query("SELECT * FROM akses WHERE user_id = '$data->user_id' AND apps_id = '$apps->apps_id'")->row();
                
                    if (!empty($akses)) {
                        $resp = [
                            'response' => [
                                'user_id' => $data->user_id,
                                'user_nama' => $data->user_nama,
                                'user_username' => $data->user_username,
                                'user_akses' => 'Allowed',
                                'app_role' => $akses->akses_role,
                                //'app_id' => $akses->apps_id,
                                'pegawai_id' => $data->pegawai_id,
                                // 'pegawai_level' => array(),
                                //'pegawai_divisi' => array(),
                                // 'pegawai_divisi_bagian' => array(),
                                'karier' => $kariers,
                                'foto_path' => $data->foto_path,
                                'token'=> $token  
                            ],
                            'metadata' => [
                                            'message' => 'OK',
                                            'code'    => 200
                            ]
                        ];
                        
                        //Hilangkan data yang tidak perlu
                        foreach ($kariers as $i => $karier) {
                            unset($resp['response']['karier'][$i]->created_at);
                            unset($resp['response']['karier'][$i]->edited_at);
                            unset($resp['response']['karier'][$i]->deleted_at);
                            unset($resp['response']['karier'][$i]->created_by);
                            unset($resp['response']['karier'][$i]->edited_by);
                            unset($resp['response']['karier'][$i]->deleted_by);
                            unset($resp['response']['karier'][$i]->is_active);
                        }
        
                        //$response = array_values($resp);
                    }else {
                        $resp = [
                            'response' => "User tidak mendapatkan akses untuk aplikasi ini!",
                            'metadata' => [
                                            'message' => 'Error',
                                            'code'    => 401
                            ]
                        ];
                    }
                }
                
            }

			//Convert to json
            header('Content-Type: application/json');
            echo json_encode($resp);

		}else {

            $response = [
                'response' => "Username dan password salah!",
                'metadata' => [
                                'message' => 'Error',
                                'code'    => 400
                ]
            ];
            //Convert to json
            header('Content-Type: application/json');
            echo json_encode($response);

        }
	}

    //HTTP GET
    public function get_pegawais()
	{
        $pegawais = $this->db->select('*')
					->from('pegawai as t1')
                    ->where('t1.is_active', 1)
					->join('master_pendidikan as t2', 't1.pendidikan_id = t2.pendidikan_id', 'LEFT')
					->order_by("pegawai_nama", "ASC")
					->get()
					->result();

        //Hilangkan data yang tidak perlu
        foreach ($pegawais as $i => $pegawai) {
            unset($pegawais[$i]->created_at);
            unset($pegawais[$i]->edited_at);
            unset($pegawais[$i]->deleted_at);
            unset($pegawais[$i]->created_by);
            unset($pegawais[$i]->edited_by);
            unset($pegawais[$i]->deleted_by);
            unset($pegawais[$i]->is_active);
            unset($pegawais[$i]->pendidikan_deskripsi);
            unset($pegawais[$i]->urutan);
        }

		//Convert to json
		header('Content-Type: application/json');
		echo json_encode($pegawais);
    }
}