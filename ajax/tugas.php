<?php

require_once '../includes/config.php';

class Tugas {
    private $conn = "";
    private $table;

    public function __construct($reason, $data) {
        $db = new koneksi();
        $this->conn = $db->getConnection();
        $this->data = $data;
        $this->table = "tugas";
        switch ($reason) {
            case 'tugas':
                $this->getData();
                break;
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
            case 'approve':
                $this->approveData();
                break;
            default:
                break;
        }

    }

    private function getData(){
        $result = array();
		$sql = "SELECT 
                        tugas.id,
                        anggota.nrp,
                        anggota.nama,
                        tugas.date, 
                        tugas.description, 
                        kriteria.keterangan as kriteria, 
                        keterampilan.keterangan as keterampilan, 
                        tugas.file,
                        tugas.bobot, 
                        tugas.status, 
                        status
                    FROM $this->table
                    inner join anggota on anggota.nrp = tugas.nrp
                    inner join kriteria on kriteria.code = tugas.criteria
                    inner join keterampilan on keterampilan.id = tugas.keterampilan ";
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

    private function editData(){
        $data = $this->data;
		$sql = "SELECT 
                    id,
                    nrp,
                    date, 
                    inputdate, 
                    criteria, 
                    keterampilan, 
                    description, 
                    file, 
                    bobot, 
                    status
                FROM 
                    $this->table
                WHERE id = $data->id";
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
        $data->nrp = $data->nrp != '' ?  $data->nrp : $_SESSION['nrp'];
        $Date = new DateTime();
        $sql = "INSERT INTO $this->table (
                                    nrp,
                                    date, 
                                    inputdate, 
                                    criteria, 
                                    keterampilan, 
                                    description, 
                                    file, 
                                    bobot, 
                                    status
                                )
                                VALUES(
                                    '$data->nrp',
                                    '$data->date', 
                                    '".$Date->format('Y-m-d H:i:s')."', 
                                    '$data->criteria',
                                    '$data->keterampilan',
                                    '$data->description',
                                    '$data->file',
                                    '$data->bobot',
                                    '$data->status'
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
        $sql = "UPDATE 
                    $this->table
                SET
                    date = '$data->date',
                    criteria = '$data->criteria',
                    keterampilan = '$data->keterampilan',
                    description = '$data->description',
                    file = '$data->file',
                    bobot = '$data->bobot'
                WHERE 
                    id = $data->id ";
        // var_dump($sql);
        $query = $this->conn->query($sql);
        if ($query) {
            $this->getData();
        }
    }

    private function deleteData() {
        $data = $this->data;
        $sql = "DELETE FROM $this->table where id = $data->id";
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

    private function approveData() {
        $data = $this->data;
        $sql = "UPDATE 
                    $this->table
                SET
                    bobot = '$data->bobot',
                    status = '1'
                WHERE 
                    id = $data->id ";
        $query = $this->conn->query($sql);
        if ($query) {
            $this->getData();
        }
    }

    
} 

new Tugas($_POST['reason'], json_decode($_POST['data']));