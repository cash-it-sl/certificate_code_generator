<?php
require_once('config.php');
?>
 <?php
 
 
 if(isset($_POST)){
     $fullname         = $_POST['fullname'];
     $nic              = $_POST['nic'];
     $event            = $_POST['event'];
     $date             = $_POST['date'];
     $certificatedis   = $_POST['certificatedis'];
     $degreetype       = $_POST['type'];
     $terms             = $_POST['term']; 
     $catid             = $_POST['catid']; 
 

     $countq = "SELECT COUNT(certificatecode)  FROM certgen WHERE event_idfk = '$event' AND term='$terms'";

     $resultcountstmt = $db ->prepare($countq);
     $resultcountstmt->execute();
     $count = $resultcountstmt ->fetchColumn();
    
     $code = sprintf('%03u', $event).sprintf('%03u', $catid).sprintf('%02u', $terms).substr($date,1,3).sprintf('%03u', $count);

     //$code = sprintf('%03u', $event).sprintf('%02u', $terms).uniqid($event , false).substr($date,1,3).sprintf('%03u', $count);

     $sql = "INSERT INTO certgen(certificatecode,f_name,nic,idate,certificate_dis,degreetype,term,event_idfk,cat_idfk) VALUES (?,?,?,?,?,?,?,?,?)";
     $stmtinsert = $db->prepare($sql);
   //  echo $fullname . " " . $nic . " " . $event . " " . $date . " " . $certificatedis . " " . $degreetype;
     $result=$stmtinsert->execute([$code ,$fullname,  $nic  ,$date, $certificatedis , $degreetype , $terms , $event ,$catid]);
     if($result){
         echo 'Certificate Code :'.$code;
     }else{
         echo "error!";
     }

 }else{
    echo "No data" ; 
 }

?>