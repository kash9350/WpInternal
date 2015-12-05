<?php include 'algo.php' ; ?>


<?php
//    if(isset($_POST['submit']))
//{
//  echo "qwert";
//} 
?>
<meta charset="utf-8"/>
<script src='../jquery/timer_jquery-1.11.1.js'></script>

<link rel="stylesheet" type="text/css" href="../css/writerTest.css">
<link rel="stylesheet" type="text/css" href="../css/reset.css">


<form name='test' action="php/execute.php" method="post">
    <h2>Determiner Test</h2><hr>
    <p>1.  &nbsp; <?php echo $determiner2_ques[0];?>
        <select name='fill1'><option></option><option value='none'>---</option><option value='a'>a</option><option value='an'>an</option><option value='the'>the</option></select> <?php echo $determiner2_ques[1];?> <select name="fill2"><option></option><option value='none'>---</option><option value='a'>a</option><option value='an'>an</option><option value='the'>the</option></select> <?php echo $determiner2_ques[2];?>
    </p>
    <p>2.  &nbsp; <?php echo $determiner3_ques[0];?>
        <select name='fill3'><option></option><option value='none'>---</option><option value='a'>a</option><option value='an'>an</option><option value='the'>the</option></select> <?php echo $determiner3_ques[1];?> <select name="fill4"><option></option><option value='none'>---</option><option value='a'>a</option><option value='an'>an</option><option value='the'>the</option></select> <?php echo $determiner3_ques[2];?> <select name="fill5"><option></option><option value='none'>---</option><option value='a'>a</option><option value='an'>an</option><option value='the'>the</option></select> <?php echo $determiner3_ques[3];?>
    </p>
    
    <p>3.  &nbsp; <?php echo $determiner4_ques[0];?>
        <select name='fill6'><option></option><option value='none'>---</option><option value='a'>a</option><option value='an'>an</option><option value='the'>the</option></select> <?php echo $determiner4_ques[1];?> <select name="fill7"><option></option><option value='none'>---</option><option value='a'>a</option><option value='an'>an</option><option value='the'>the</option></select> <?php echo $determiner4_ques[2];?> <select name="fill8"><option></option><option value='none'>---</option><option value='a'>a</option><option value='an'>an</option><option value='the'>the</option></select> <?php echo $determiner4_ques[3];?> <select name="fill9"><option></option><option value='none'>---</option><option value='a'>a</option><option value='an'>an</option><option value='the'>the</option></select> <?php echo $determiner4_ques[4];?>
    </p>
    <br>
    
    <h2>Scrambled Words</h2><hr>
    <p><?php echo $scramble1_qsn; ?><br>
    <input type="text" name="scramble1"/>
    </p>
    
    <p><?php echo $scramble2_qsn; ?><br>
    <input type="text" name="scramble2"/>
    </p>
    
    <p><?php echo $scramble3_qsn; ?><br>
    <input type="text" name="scramble3"/>
    </p>
    
    <p><?php echo $scramble4_qsn; ?><br>
    <input type="text" name="scramble4"/>
    </p>
    <br>
    
    <h2>Confusing Words</h2><hr>
    
    <h3>  1.&nbsp; <?php echo $wordGame1_qsn[0] ?></h3>
    <p class="qsn1"> &nbsp; &nbsp; • <?php echo $wordGame1_qsn[1] ?> <select id="list1" onchange="onChngFxn('.qsn1')" name="wordGame1"><option></option>
        <option id="opt1" value="opt1"><?php echo $wordGame1_opt[0] ?> </option>
        <option id="opt2" value="opt2"><?php echo $wordGame1_opt[1] ?></option></select> <?php echo $wordGame1_qsn[2] ?><br> &nbsp; &nbsp; • <?php echo $wordGame1_qsn[3] ?> <select id="list2" onchange="onChngFxn('.qsn1')" name="wordGame2"><option></option>
        <option id="opt1" value="opt1"><?php echo $wordGame1_opt[0] ?></option>
        <option id="opt2" value="opt2"><?php echo $wordGame1_opt[1] ?></option></select><?php echo $wordGame1_qsn[4] ?>
    </p>
    
    
    
    
    
    
    
    
    
    
  
    
    
    
    
    
    
    <h3>  2.&nbsp; <?php echo $wordGame2_qsn[0] ?></h3>
    <p class="qsn2"> &nbsp; &nbsp; • <?php echo $wordGame2_qsn[1] ?> <select id="list1" onchange="onChngFxn('.qsn2')" name="wordGame3"><option></option>
        <option id="opt1" value="opt1"><?php echo $wordGame2_opt[0] ?> </option>
        <option id="opt2" value="opt2"><?php echo $wordGame2_opt[1] ?></option></select> <?php echo $wordGame2_qsn[2] ?><br> &nbsp; &nbsp; • <?php echo $wordGame2_qsn[3] ?> <select id="list2" onchange="onChngFxn('.qsn2')" name="wordGame4"><option></option>
        <option id="opt1" value="opt1"><?php echo $wordGame2_opt[0] ?></option>
        <option id="opt2" value="opt2"><?php echo $wordGame2_opt[1] ?></option></select><?php echo $wordGame2_qsn[4] ?>
    </p>
    
    
    
    
    
    
    <h3>  3.&nbsp; <?php echo $wordGame3_qsn[0] ?></h3>
    <p class="qsn3"> &nbsp; &nbsp; • <?php echo $wordGame3_qsn[1] ?> <select id="list1" onchange="onChngFxn('.qsn3')" name="wordGame5"><option></option>
        <option id="opt1" value="opt1"><?php echo $wordGame3_opt[0] ?> </option>
        <option id="opt2" value="opt2"><?php echo $wordGame3_opt[1] ?></option></select> <?php echo $wordGame3_qsn[2] ?><br> &nbsp; &nbsp; • <?php echo $wordGame3_qsn[3] ?> <select id="list2" onchange="onChngFxn('.qsn3')" name="wordGame6"><option></option>
        <option id="opt1" value="opt1"><?php echo $wordGame3_opt[0] ?></option>
        <option id="opt2" value="opt2"><?php echo $wordGame3_opt[1] ?></option></select><?php echo $wordGame3_qsn[4] ?>
    </p>
    
     <br>   
    
    <br> <hr><br>
    
    
    
    
    
    
    <button id="ansSub" type="submit" value="<?php echo $temp; ?>" name="one">Submit Answers</button>
</form>




