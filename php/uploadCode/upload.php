<?php

include('dbConn.php');
if (isset($_POST['username']))
{
	$Username=$_POST['username'];
}


	if(isset($_FILES['doc'])){
		$file_name="noname";
	        if(isset($_POST['orderID']))
	        {
	        	$file_name=$_POST['orderID'];
	        }
		$errors= array();
		        	
        
		$file_size =$_FILES['doc']['size'];
		$file_tmp =$_FILES['doc']['tmp_name'];
		$file_type=$_FILES['doc']['type'];   
		$file_ext=strtolower(end(explode('.',$_FILES['doc']['name'])));
        
		$file_name=$file_name.".".$file_ext;
		$expensions= array("docx","pdf","doc"); 		
		if(in_array($file_ext,$expensions)=== false){
			$errors="Upload Failed: Extension not allowed, please choose a Word Document or a pdf file.";
		}
		if($file_size > 8388608){
		$errors='Upload Failed: File size must be less than 8 MB';
		}				
		if(empty($errors)==true){
            
            
            		$uploadedData="UPDATE writerprofile SET uploaded='1', uploadedFilename='".$file_name."' WHERE email='".$Username."'";
            		mysqli_query($conn, $uploadedData);
            		
			move_uploaded_file($file_tmp,"../../uploads/writers/".$file_name);
                        echo "<h3>Uploaded Successfully</h3>";
		}else{
			echo("<h3>".$errors."</h3>");
		}
                echo "<h4>Redirecting back to upload page<h4>";
	}
?>

<script>
setTimeout(function(){redirect()},2000);
function redirect(){
   window.location.assign("../../writersHomepage.php");
}
</script>