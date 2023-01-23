<?php

include '../includes/config.php';

class Anggota {
    private $conn = "";
    private $table;

    public function __construct($reason, $data) {
        $db = new koneksi();
        $this->conn = $db->getConnection();
        $this->data = $data;
        $this->table = "anggota";
        switch ($reason) {
            case 'data':
                $this->getData();
                break;
            case 'save':
                $this->saveData();
                break;
            case 'saveedit':
                $this->saveEdit();
                break;
            case 'edit':
                $this->editData();
                break;
            case 'delete':
                $this->deleteData();
                break;
            default:
                break;
        }

    }

    private function getData(){
        $result = [];
		$sql = "SELECT 
                    anggota.nrp, 
                    anggota.nama, 
                    pangkat.nama as pangkat, 
                    jabatan.nama as jabatan,  
                    anggota.tggl_menjabat 
                FROM anggota
                LEFT JOIN pangkat ON pangkat.id = anggota.pangkat
                LEFT JOIN jabatan ON jabatan.id = anggota.jabatan";
        $query = $this->conn->query($sql);
        while ($row =  mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
        
        $send = array(
            'code' => 200,
            'message' => 'success',
            'result' => $result,
        );

        echo json_encode($send);
	}
    
    private function saveData(){
        $data = $this->data;
        $data->password = MD5($data->password);
        $data->dateTmp = date('Y-m-d H:i:s');
        $sql = "INSERT INTO $this->table (
                                    nrp, 
                                    nama,
                                    password, 
                                    pangkat, 
                                    jabatan, 
                                    tggl_menjabat, 
                                    file,
                                    create_at
                                )
                                VALUES(
                                    '$data->nrp', 
                                    '$data->nama', 
                                    '$data->password', 
                                    '$data->selectPangkat', 
                                    '$data->selectJabatan', 
                                    '$data->menjabat', 
                                    '$data->selectFile',
                                    '$data->dateTmp'
                                )";
        $query = $this->conn->query($sql);
        if ($query) {
            $this->getData();
        }else{
            $send = array(
                'code' => 201,
                'message' => 'Data Tidak dapat disimpan',
                'result' => $data,
            );
            echo json_encode($send);
        }
    }

    private function saveEdit(){
        $data = $this->data;
        if($data->password != ''){
            $data->password = MD5($data->password);
            $sql = "UPDATE 
                    $this->table
                SET
                    nama = '$data->nama',
                    password = '$data->password',
                    pangkat = '$data->selectPangkat',
                    jabatan = '$data->selectJabatan',
                    tggl_menjabat = '$data->menjabat'
                WHERE
                    nrp = '$data->nrp'";
        }else{
            $sql = "UPDATE 
                    $this->table
                SET
                    nama = '$data->nama',
                    pangkat = '$data->selectPangkat',
                    jabatan = '$data->selectJabatan',
                    tggl_menjabat = '$data->menjabat'
                WHERE
                    nrp = '$data->nrp' ";
        }
        $query = $this->conn->query($sql);
        if($query){
            $this->getData();
        }else{
            $send = array(
                'code' => 201,
                'message' => 'Data Tidak dapat disimpan',
                'result' => $data,
            );
            echo json_encode($send);
        }
    }


    private function editData(){
        $data = $this->data;
		$sql = "SELECT 
                    nrp, 
                    nama, 
                    pangkat, 
                    jabatan, 
                    tggl_menjabat 
                FROM 
                    $this->table
                WHERE nrp =  $data->id";
        $query = $this->conn->query($sql);
        while ($row =  mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
        
        $send = array(
            'code' => 200,
            'message' => 'success',
            'result' => $result,
        );

        echo json_encode($send);
	}

    private function deleteData(){
        $data = $this->data;
        $sql = "DELETE FROM $this->table where nrp = $data->id";
        $query = $this->conn->query($sql);
        if ($query) {
            $this->getData();
        }else{
            $send = array(
                'code' => 201,
                'message' => 'Data Tidak dapat disimpan',
                'result' => $query,
            );
            echo json_encode($send);
        }
    }
    
} 

new Anggota($_POST['reason'], json_decode($_POST['data']));