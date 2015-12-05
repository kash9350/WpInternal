<?php

include('dbConn.php');
if (isset($_POST['MyWpwriter']))
{
	$Username=$_POST['MyWpwriter'];
}


	if(isset($_FILES['doc'])){
		$file_name="noname";
	        if(isset($_POST['WporderID']))
	        {
	        	$file_name=$_POST['WporderID'];
	        	
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
            		
            
            		
            	
            		
			move_uploaded_file($file_tmp,"../uploads/writers/".$file_name);
			
			
			if (file_exists("../uploads/writers/".$file_name)) {
  				  //echo "Success";
  				  	$uploadedData="UPDATE writerprofile SET canClaim='1' WHERE email='".$Username."'";
  				  
  				 	mysqli_query($conn, $uploadedData);
  				 	mysqli_query($conn, "UPDATE writerWpRecord SET uploadedFilename='".$file_name."', finalstatus='Uploaded' WHERE email='".$Username."'");
  				 	mysqli_query($conn, "UPDATE businesshomepage SET writerUploaded='1', claimedWriter='".$Username."' WHERE txnid='".$_POST['WporderID']."'");
				}
				
                        //echo "<h3>Uploaded Successfully</h3>";
		}else{
			//echo("<h3>".$errors."</h3>");
		}
                //echo "<h4>Redirecting back to upload page<h4>";
	}
?>

<script>
window.location.assign("../writers/");
/*
setTimeout(function(){redirect()},2000);
/*function redirect(){
   window.location.assign("../../writersHomepage.php");
}*/
</script>