<?php
include('dbConn.php');
$sampleCk=mysqli_query($conn, "SELECT ID, paygrade, catagory FROM writerskillsample WHERE email='".$Username."'");

if(mysqli_num_rows($sampleCk)>0)
{
   
    $payTemp=1;
    while($row = mysqli_fetch_assoc($sampleCk)) 
    {
        if ($row["paygrade"]=='')
        { $paygrade[$payTemp]="Sample under review";}
        else
        {
        $paygrade[$payTemp]=$row["paygrade"];
        }
        $area[$payTemp]=$row["catagory"];
        $payTemp++;
    }
  
}
else
{
    $payTemp=0;
}


$profile2Check="SELECT mobileNo, address, city, state, zipCode, myReferences FROM writerprofile WHERE email='".$Username."'";

$con3=mysqli_fetch_object(mysqli_query($conn, $profile2Check));

$mobileNo=$con3->mobileNo;
$address=$con3->address;
$city=$con3->city;
$state=$con3->state;
$zipCode=$con3->zipCode;
$myReferences=$con3->myReferences ;
?>

<h2>Leaderboard<hr></h2>
                    <?php if($payTemp!=0){  
                    echo "<table class='table' >
                         <thead><tr >
                            <th style='font-size:17px;'>Area of expertise</th>
                            <th style='font-size:17px;'>Level</th> 
                        </tr></thead><tbody >";
                    for($i=$payTemp;$i--;){
                        if ($i>0){
                        echo "<tr class='success'>
                            <td>".$area[$i]."</td>
                            <td>".$paygrade[$i]."</td> 
                        </tr>";
                        }}
                    echo "</tbody></table>"; 
                    }
                    else {echo "No sample uploaded";}
                    ?>
                    
                    <br>
<style>
    input, select, textarea
    {
        border-color:black;
        border-width:1px;
        padding: 2px 10px 2px 10px;
    }
    
    input, select
    {
        width:270px;
    }
</style>
                <h2>Improve Your Skill<hr></h2>
                    <h4 id="sampleTest">You can now improve your writing level by a sample <a  href="../writerSampleArea.html">TEST</a>
                    </h4>


                    
                <form action="../php/databaseCall/profile2CallWriter.php"  method="post">
                    
                    <h2>Address<hr/></h2>
                    
                    <table class='table' style='vertical-align:center;'>
                        <tbody>
                            <tr class="success">
                                <td>Mobile Number:</td>
                                <td><input name='mobileNo' type="text" value='<?php echo '+91'.$mobileNo; ?>'/></td>
                            </tr>
                            <tr class="success">
                                <td>Address:</td>
                                <td><input name="address"  type="text" value='<?php echo $address; ?>' /></td>
                            </tr>
                            
                            <tr class="success">
                                <td>City:</td>
                                <td><input name="city" value="<?php echo $city; ?>" type="text"/></td>
                            </tr>
                            <tr class="success">
                                <td>State:</td>
                                <td><select  name="state">
                            <option value="">Select your State</option>
                            
                            
<option value='Andaman and Nicobar Islands'>Andaman and Nicobar Islands</option>
<option value='Andhra Pradesh'>Andhra Pradesh</option>
<option value='Arunachal Pradesh'>Arunachal Pradesh</option>
<option value='Assam'>Assam</option>
<option value='Bihar'>Bihar</option>
<option value='Chandigarh'>Chandigarh</option>
<option value='Chhattisgarh'>Chhattisgarh</option>
<option value='Dadra and Nagar Haveli'>Dadra and Nagar Haveli</option>
<option value='Daman and Diu'>Daman and Diu</option>
<option value='Delhi'>Delhi</option>
<option value='Goa'>Goa</option>
<option value='Gujarat'>Gujarat</option>
<option value='Haryana'>Haryana</option>
<option value='Himachal Pradesh'>Himachal Pradesh</option>
<option value='Jammu and Kashmir'>Jammu and Kashmir</option>
<option value='Jharkhand'>Jharkhand</option>
<option value='Karnataka'>Karnataka</option>
<option value='Kerala'>Kerala</option>
<option value='Lakshadweep'>Lakshadweep</option>
<option value='Madhya Pradesh'>Madhya Pradesh</option>
<option value='Maharashtra'>Maharashtra</option>
<option value='Manipur'>Manipur</option>
<option value='Meghalaya'>Meghalaya</option>
<option value='Mizoram'>Mizoram</option>
<option value='Nagaland'>Nagaland</option>
<option value='Odisha'>Odisha</option>
<option value='Puducherry'>Puducherry</option>
<option value='Punjab'>Punjab</option>
<option value='Rajasthan'>Rajasthan</option>
<option value='Sikkim'>Sikkim</option>
<option value='Tamil Nadu'>Tamil Nadu</option>
<option value='Telengana'>Telengana</option>
<option value='Tripura'>Tripura</option>
<option value='Uttar Pradesh'>Uttar Pradesh</option>
<option value='Uttarakhand'>Uttarakhand</option>
<option value='West Bengal'>West Bengal</option>

                        </select>
                    
                                </td>
                            </tr>
                            
                            <tr class="success">
                                <td>Pin Code:</td>
                                <td><input name="zipCode" value="<?php echo $zipCode ?>" type="text"/></td>
                            </tr>
                            </tbody>
                    </table>
                    
                    <br/><br/>
                    <h2>Profession</h2><hr>
                    <h4>Content references</h4><br>
                    <textarea rows="7" cols="50"  name='writerReferences' ><?php if ($myReferences==''){ echo 'Give links to some of your existing work.';}
else{
  echo $myReferences;
} ?></textarea><br><br><br>
                    
                    
                    <h3><input id="update_but" type="submit" value='Update'></h3>
                            
                    </form>