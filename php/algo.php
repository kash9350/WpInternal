<?php

include('databaseCall/wpdbConn/dbConn.php');

$temp=rand(1,9);

$sql = "SELECT determiner2_ques, determiner2_ans1, determiner2_ans2, determiner3_ques, determiner3_ans1, determiner3_ans2, determiner3_ans3, determiner4_ques, determiner4_ans1, determiner4_ans2, determiner4_ans3	, determiner4_ans4, scramble1_qsn, scramble1_ans, scramble2_qsn, scramble2_ans, scramble3_qsn, scramble3_ans, scramble4_qsn, scramble4_ans, wordGame1_qsn, wordGame1_opt1, wordGame1_opt2, wordGame1_ans1, wordGame1_ans2, wordGame2_qsn, wordGame2_opt1, wordGame2_opt2, wordGame2_ans1, wordGame2_ans2, wordGame3_qsn, wordGame3_opt1, wordGame3_opt2, wordGame3_ans1, wordGame3_ans2 FROM writertestquestions WHERE ID='".$temp."'";

$con1=mysqli_fetch_object(mysqli_query($conn, $sql));

$determiner2_ques=explode("*",$con1->determiner2_ques);
$determiner3_ques=explode("*",$con1->determiner3_ques);
$determiner4_ques=explode("*",$con1->determiner4_ques);

$scramble1_qsn=$con1->scramble1_qsn;
$scramble2_qsn=$con1->scramble2_qsn;
$scramble3_qsn=$con1->scramble3_qsn;
$scramble4_qsn=$con1->scramble4_qsn;

$wordGame1_qsn=explode("*",$con1->wordGame1_qsn);
$wordGame2_qsn=explode("*",$con1->wordGame2_qsn);
$wordGame3_qsn=explode("*",$con1->wordGame3_qsn);

$wordGame1_opt=array($con1->wordGame1_opt1, $con1->wordGame1_opt2);
$wordGame2_opt=array($con1->wordGame2_opt1, $con1->wordGame2_opt2);
$wordGame3_opt=array($con1->wordGame3_opt1, $con1->wordGame3_opt2);


?>