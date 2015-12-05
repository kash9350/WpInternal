<?php



    
    if (isset($_GET['areaCode']))
    {
        $tempArea=($_GET['areaCode']);
        
        
    }

    
    


include('databaseCall/wpdbConn/dbConn.php');

if ($conn->connect_error)
{
    die("connecton failed:".$conn->connect_error);
}

function topic($tempRan)
{
    global $tempArea;
    global $conn;
    $sampQsn="SELECT $tempArea FROM expertisesamplequestion WHERE ID='".$tempRan."'";
    $con1=mysqli_fetch_object(mysqli_query($conn, $sampQsn));
    return $con1->$tempArea;
}


$numbers = range(1, 10);
shuffle($numbers);


?>

<form method="post" action="php/databaseCall/writerSampleEntry.php?codeName=<?php echo $tempArea;?>">
    <p>Write 150 words on the given topic</p>
    
    <h3 style="color:#2eb161"><u>Topic:</u> <br>
        <input required type="radio" value='<?php echo topic($numbers[0]); ?>' name="topic"><?php echo topic($numbers[0]); ?><br> 
        
        <input required type="radio" value="<?php echo topic($numbers[3]); ?>" name="topic"><?php echo topic($numbers[3]); ?><br>
        <input required type="radio" value="<?php echo topic($numbers[8]); ?>" name="topic"><?php echo topic($numbers[8]); ?>
    
    </h3>
    <textarea required id="area" name="expertAreaSample" ROWS=14 COLS=90 placeholder="Place your sample here"></textarea>
    <br><br>
    
    <button id="ansSub" type="submit"  name="one">Submit Sample</button>
</form>