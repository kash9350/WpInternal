<?php

$filedownload=mysqli_query($conn, "SELECT receivedFile FROM businesshomepage WHERE email='".$_SESSION['username']."' AND received=1");
$filename=mysqli_fetch_object($filedownload)->receivedFile ;


if (mysqli_num_rows($filedownload)==0)
{
	echo "<h1>No Content Received</h1>
                    <img src='../images/receivedContent.png'/>";
}
else
{
	echo "<h1>File received. Click the download button.</h1>";
	echo "<a href='../uploads/editors/".$filename."' download style='color:#2eb161; font-size:20px;'> Download Now</a>";
}
?>