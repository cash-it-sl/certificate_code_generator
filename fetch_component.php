<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'certficategenerator');

require_once('config.php');
$certGen = new CertificateGenerator($connection);

if (isset($_POST['search_post_btn'])) {
    $id = $_POST['id'];
    $table = $certGen->generateCertificateTable($id);
    echo $table;
} else {
    echo "No data";
}

class CertificateGenerator {
    private $connection  ;
    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function generateCertificateTable($id) {
        $query = "SELECT * FROM certgen WHERE certificatecode = '$id'";
        $result = mysqli_query($this->connection, $query);

        if ($result) {
            $table = "<table class='content-table'>";
            while ($row = mysqli_fetch_array($result)) {
                $table .= "<tr>";
                $table .= "<th class='msg'>ID</th>";
                $table .= "<td class='tbd'>" . $row['certificatecode'] . "</td>";
                $table .= "</tr>";
                $table .= "<tr>";
                $table .= "<th class='msg'>Full Name</th>";
                $table .= "<td class='tbd'>" . $row['f_name'] . "</td>";
                $table .= "</tr>";
                $table .= "<tr>";
                $table .= "<th class='msg'>NIC</th>";
                $table .= "<td class='tbd'>" . $row['certificate_dis'] . "</td>";
                $table .= "</tr>";
                $table .= "<tr>";
                $table .= "<th class='msg'>Event Name</th>";
                $table .= "<td class='tbd'>" . $row['event_idfk'] . "</td>";
                $table .= "</tr>";
                $table .= "<tr>";
                $table .= "<th class='msg'>Date</th>";
                $table .= "<td class='tbd'>" . $row['idate'] . "</td>";
                $table .= "</tr>";
                $table .= "<tr>";
                $table .= "<th class='msg'>Description</th>";
                $table .= "<td class='tbd'>" . $row['certificate_dis'] . "</td>";
                $table .= "</tr>";
                
               
            }
            $table .= "</table>";
            return $table;
        } else {
            return "Error!";
        }
    }
}
?>
