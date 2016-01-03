<?php

include('db_conn.php');

if (isset($_POST['writerEmail']) && isset($_POST['wporderID']) && isset($_POST['writerStatus']))
{
    if ($_POST['writerStatus']==1)
    {
          
        date_default_timezone_set('Asia/Calcutta');
        $thisdate=date("Y-m-d H:i:s");

        
         
        /*Update for Writer Claimed activity to approved*/
        $conn->query("UPDATE writerwprecord SET finalstatus='Approved', amountReceived='".$_POST['paidAmount']."', ApprovalDateAndTime='".$thisdate."' WHERE claimedOrderID='".$_POST['wporderID']."' AND writeremail='".$_POST['writerEmail']."'");
        
        
        /*Taking current balance from subject */
        $writerCurrentBalance=(mysqli_fetch_object($conn->query("SELECT balance FROM wpsecurepayment WHERE email='".$_POST['writerEmail']."'")))->balance;
        
        
        $writerBalUpdatedVal=$writerCurrentBalance+ $_POST['paidAmount'];
        
        
        /*Creating transaction history in writer database*/
        $conn->query("INSERT INTO writertransactionhistory (email, addedAmount, netBalance, transactionDate) VALUES ('".$_POST['writerEmail']."', '$writerCurrentBalance', '$writerBalUpdatedVal', '$thisdate')");
        
        
        
        /*Update Subject's Balance Database*/
        $conn->query("UPDATE wpsecurepayment SET balance='".$writerBalUpdatedVal."', lastUpdatedTime='".$thisdate."' WHERE email='".$_POST['writerEmail']."'");
        
        
        
        
        /*UPDATE CLIENT editor review starting.*/
        $conn->query("UPDATE businesshomepage SET editorReview='1' WHERE txnid='".$_POST['wporderID']."'");
        
        
        
    }
}




