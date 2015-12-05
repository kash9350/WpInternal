<?php

include('db_conn.php');

if (isset($_POST['writerEmail']) && isset($_POST['wporderID']) && isset($_POST['writerStatus']))
{
    if ($_POST['writerStatus']==1)
    {
          
        date_default_timezone_set('Asia/Calcutta');
        $thisdate=date("Y-m-d H:i:s");

        
        $conn->query("UPDATE writerwprecord SET finalstatus='Approved', amountReceived='".$rs['paidAmount']."', ApprovalDateAndTime='".$thisdate."' WHERE claimedOrderID='".$rs['txnid']."' AND writeremail='".$rs['claimedWriter']."'");
        
    }
}





?>