<?php   
    function checkuser($username, $password) {
        $conn=connect_db();
        $stmt = $conn->prepare("SELECT * FROM user WHERE username='".$username."' AND password='".$password."'");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt->fetchAll();
        if(count($kq) > 0) return $kq[0]['role'];
        else return 0;        
    }
?>