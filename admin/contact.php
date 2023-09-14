<?php

include_once __DIR__.'/../layouts/sidebar.php';
include_once __DIR__.'/../controller/contactController.php';
$contact_con=new contactController();
$contacts=$contact_con->getcontact();

?>

    <main class="content">
        <div class="container">
            <div class="row">
            <h2 class="text-center text-danger text-uppercase">Recommendation Letter</h2>
                
                <table class="table table-striped" id="mytable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Recommendation Message</th>
                        <th>Mail</th>    
                    </tr>
                </thead>
                
                <tbody>
                <?php
                    $count=1;
                    foreach($contacts as $contact){
                        echo "<tr>";
                        echo "<td>" .$count++. "</td>";
                        echo "<td>" . $contact['Name'] ."</td>";
                        echo "<td>" . $contact['Email'] ."</td>";
                        echo "<td>" . $contact['PhNo'] ."</td>";
                        echo "<td>" . $contact['Content'] ."</td>";
                        if($contact['Email_Status']==0)
                        {
                            echo "<td id='".$contact['Id']."'><a href='send_contact.php?id=".$contact['Id']."' class='btn btn-info'>Send</a></td>";
                        }
                        else{
                                echo "<td><a class='btn btn-info' disabled>Send</a></td>";
                            }
                        }       
                    
                    ?>
                </tbody>
            </table>
            </div>        
        </div>
    </main>
<?php
include_once __DIR__.'/../layouts/footer.php';
?>