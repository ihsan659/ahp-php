<?php

require_once '../includes/config.php';

class Perbandingan {
    private $conn = "";
    private $table;

    public function __construct($reason, $data) {
        $db = new koneksi();
        $this->conn = $db->getConnection();
        $this->data = $data;
        switch ($reason) {
            case 'data':
                $this->getData();
                break;
            case 'reset':
                $this->resetData();
                break;
            default:
                break;
        }

    }

    private function getData(){
        $sql = "SELECT 
                    pertama,
                    nilai,
                    hasil,
                    kedua
                FROM analisa_kriteria";
        $query = $this->conn->query($sql);
        if($query){          
            while($row =  mysqli_fetch_assoc($query)){
                $hasil[] = $row;
            }
    
            $kriteri = $this->getKriteria();
            $length = count($kriteri);
            $index = 0;
            for($i = 0; $i < $length; $i++){
                for($j = 0; $j < $length; $j++){
                    $result[$i][] = $hasil[$index]['hasil'];
                    $index++;
                }
            }
        }else{
            $result = [];
        }

        $send = array(
            'code' => 200,
            'message' => 'success',
            'result' => $result,
        );
        echo json_encode($send);
	}

    private function resetData(){
        $sql = "DELETE FROM analisa_kriteria";
        $query = $this->conn->query($sql);
        if ($query) {
            $send = array(
                'code' => 200,
                'message' => 'Success'
            );
        }else{
            $send = array(
                'code' => 201,
                'message' => 'Data Tidak dapat disimpan'
            );
        }
        echo json_encode($send);
    }

    private function getAlternatif (){
        $result = array();
		$sql = "SELECT 
                    kepentingan,
                    keterangan
                FROM alternatif ORDER BY kepentingan ASC";
        $query = $this->conn->query($sql);
        while ($row =  mysqli_fetch_assoc($query)){
            $result[] = $row;
        }

        return $result;
    }
    private function getKriteria (){
        $result = array();
		$sql = "SELECT 
                    code,
                    bobot
                FROM kriteria ";
        $query = $this->conn->query($sql);
        while ($row =  mysqli_fetch_assoc($query)){
            $result[] = $row;
        }

        return $result;
    }
    
} 

new Perbandingan($_POST['reason'], json_decode($_POST['data']));