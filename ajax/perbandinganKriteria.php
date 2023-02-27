<?php

require_once '../includes/config.php';

class Perbandingan {
    private $conn = "";
    private $table;

    public function __construct($reason, $session, $data) {
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
        $hasil = array();
        $eigenData = array();
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
            if(count($hasil) > 0){
                $eigenData = $this->eigenData();
                $sumKriteria = $this->sumKriteria();
                $kriteri = $this->getKriteria();
                $length = count($kriteri);
                $index = 0;
                for($i = 0; $i < $length; $i++){
                    for($j = 0; $j < $length; $j++){
                        $result[$i][] = $hasil[$index]['hasil'];
                        $index++;
                    }
                    $arraySum[] = $sumKriteria[$i]['total'];
                }
                array_push($result, $arraySum);
            }else{
                $result = [];
            }
        }else{
            $result = [];
        }

        $send = array(
            'code' => 200,
            'message' => 'success',
            'result' => $result,
            'eigen' => $eigenData
        );
        echo json_encode($send);
	}
    private function eigenData(){
        $sumKriteria = $this->sumKriteria();
        $sql = "SELECT 
                    pertama,
                    nilai,
                    hasil,
                    kedua
                FROM analisa_kriteria";
        $query = $this->conn->query($sql);
        $kriteri = $this->getKriteria();
        $length = count($kriteri);
        $index = 0;
        if($query){          
            while($row =  mysqli_fetch_assoc($query)){
                $hasil[] = $row;
            }
            if(count($hasil) > 0){
                for($i = 0; $i < $length; $i++){
                    for($j = 0; $j < $length; $j++){
                        $result[$i][] = ($hasil[$index]['hasil'])/($sumKriteria[$j]['total']);
                        $index++;
                    }
                    $total = array_sum($result[$i]);
                    $result[$i][] = $total;
                    $result[$i][] = $total/$length;
                }
            }else{
                $result = [];
            }
        }else{
            $result = [];
        }

        return $result;
    }

    private function resetData(){
        $sql = "DELETE FROM analisa_kriteria";
        $query = $this->conn->query($sql);
        if ($query) {
            return $this->getData();
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
    private function sumKriteria() {
        $sql = "SELECT 
                    kedua,
                    sum(hasil) as total
                FROM analisa_kriteria
                group by kedua
                order by kedua ASC";
        $query = $this->conn->query($sql);
        while ($row =  mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
        return $result;
    }
    
} 

new Perbandingan($_POST['reason'], json_decode($_POST['session']), json_decode($_POST['data']));