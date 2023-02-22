<?php

include '../includes/config.php';

class Session {
    private $conn = "";
    private $table;

    public function __construct($reason, $data) {
        $db = new koneksi();
        $this->conn = $db->getConnection();
        $this->data = $data;
        $this->table = "anggota";
        switch ($reason) {
            case 'login':
                $this->getLogin();
                break;
            case 'savedata':
                $this->saveData();
                break;
            default:
                break;
        }

    }
    private function getLogin(){
        $data = $this->data;
        $sql = "SELECT 
                    $this->table.nrp, 
                    $this->table.nama, 
                    $this->table.password, 
                    $this->table.pangkat, 
                    $this->table.jabatan, 
                    $this->table.tggl_menjabat, 
                    $this->table.file, 
                    $this->table.create_at,
                    jabatan.status
                FROM 
                    $this->table 
                    LEFT JOIN jabatan ON jabatan.id = $this->table.jabatan
                WHERE 
                    $this->table.nrp = '". $data->username. "' AND
                    $this->table.password = '". MD5($data->password). "' ";
        // var_dump($sql);
        $query = $this->conn->query($sql);
        $row =  mysqli_fetch_array($query);
        if($row){
            $_SESSION['nrp'] = $row['nrp'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['jabatan'] = $row['jabatan'];
            $_SESSION['pangkat'] = $row['pangkat'];
            $_SESSION['tggl_menjabat'] = $row['tggl_menjabat'];
            $_SESSION['images'] = $row['file'];
            $_SESSION['role'] = $row['status'];
            $result = array(
                'code' => 200,
                'status' =>'success',
                'data' => $data,
            );
        }else{
            $result = array(
                'code' => 401,
                'status' => 'User not found'
            );
        }
        
        echo json_encode($result);
    } 
}
new Session($_POST['reason'], json_decode($_POST['data']));