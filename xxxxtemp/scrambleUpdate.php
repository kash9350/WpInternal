<?php

$qsn=array("Mianardn has the hshiegt nebumr of skreepas in the wrlod", "He cuhagt his sarerecty sneltaig ppaer cplis from the oficfe", "Crtnueios which wree part of the Bsitrih eiprme take part In the Cealnmotmwoh games", "She saw the leehtar bag in the daspily and immdieetaly deidced to buy it", "Htunnig fxoes is a pluopar paitmse in the Uietnd Kignodm", "Aamnil rtgihs gpuros wrok day and ngiht to prenvet cltreuy aniagst amilnas", "His Ghfedaartnr gave him that dmnoaid suedtdd watch", "She saw the lteeahr bag in the dapsliy and imeetmaildy diecedd to buy it", "He chguat his sreetcray sienatlg ppear cipls form the offcie","
He anedtts aengr megenamant csaesls every weneekd atefr ccruhh",
"Every day atefr scohol he wroks at the suepmearrkt",
"Tvielesoin and vdieo gaems are the raeson cdehlirn are osbee",
"He bnuerd down the husoe aeftr tnriyg to dry btlote rokects in the mocawrive",
"He is bleessd wtih an alhtteic frame and cmanrihg pontirasley",
"His geart gaefhdtnrar fghout in the gerat war alisogdne his geart getnodhmarr",
"His fielbxle wkoring huors and sytilsh atrtie is wlel lvoed by the bsos",
"Tisioveeln and vedio gmaes are the roaesn clierhdn are oesbe",
"He aedtnts anger mageamennt csslaes ervey wkeneed atefr cuchrh",
"My ngeobuihr lieks kinillg cleiaarptlrs with a hemmar",
"Bieng a rnigag ahcoiolcl, he was snenuhd by his fiamly",
"Taht kid teird to jump off the eghit foolr but was svead by the femerin",
"Beervas are one of nu’rates fesnit ahicrttecs",
"He iehtrenid taht sguohtn from his ftaher",
"The Roanms used cuatlatps to lay sgeie on welald frtos",
"Cienhse food altugohh tatsy , has a lot of MSG",
"Pekarr and lcok pnckiig are smoe of his fovuiarte ptmseais",
"He ihieenrtd that stoghun from his fethar",
"The prmie mneitisr came to town to iuagunrtae the loacl hoisatpl",
"The hoatspil was rbboed by the loacl drug ctarel",
"He sepnt the sumemr bndiluig a meodl rcoekt",
"Grlis aipartpcee a man who taetrs tehm rptfelseculy",
"Dietspe bneig trehe galos down , he rleilad his taem to vcoirty",
"I was preisomd a paluintm band on my bihatdry",
"He seuccumbd to his ghounst wuodns entlevauly",
"He eats an alppe and dirnks a bnanaa skhae erevy minrnog",
"The hosptail was roebbd by the lacol drug ceartl");



$ans=array(
"Mandarin has the highest number of speakers in the world",
"He caught his secretary stealing paper clips from the office",
"Countries which were part of the British empire take part In the Commonwealth games",
"She saw the leather bag in the display and immediately decided to buy it",
"Hunting foxes is a popular pastime in the United Kingdom",
"Animal rights groups work day and night to prevent cruelty against animals",
"His Grandfather gave him that diamond studded watch",
"She saw the leather bag in the display and immediately decided to buy it",
"He caught his secretary stealing paper clips from the office",
"He attends anger management classes every weekend after church",
"Every day after school he works at the supermarket",
"Television and video games are the reason children are obese",
"He burned down the house after trying to dry bottle rockets in the microwave",
"He is blessed with an athletic frame and charming personality",
"His great grandfather fought in the great war alongside his great grandmother",
"His flexible working hours and stylish attire is well loved by the boss",
"Television and video games are the reason children are obese",
"He attends anger management classes every weekend after church",
"My neighbour likes killing caterpillars with a hammer",
"Being a raging alcoholic, he was shunned by his family",
"That kid tried to jump off the eight floor but was saved by the firemen",
"Beavers are one of nature’s finest architects",
"He inherited that shotgun from his father",
"The Romans used catapults to lay siege on walled forts",
"Chinese food although tasty , has a lot of MSG",
"Parker and lock picking are some of his favourite pastimes",
"He inherited that shotgun from his father",
"The prime minister came to town to inaugurate the local hospital",
"The hospital was robbed by the local drug cartel",
"He spent the summer building a model rocket",
"Girls appreciate a man who treats them respectfully",
"Despite being three goals down , he rallied his team to victory",
"I was promised a platinum band on my birthday",
"He succumbed to his gunshot wounds eventually",
"He eats an apple and drinks a banana shake every morning",
"The hospital was robbed by the local drug cartel");


include("dbConn.php");

function escapeString($str)
{
    global $conn;
    return mysqli_real_escape_string($conn, $str);
    
}

for ($i=0; $i<9; $i++)
{
    
   $updateQsn="UPDATE writertestquestions SET scramble1_qsn='".escapeString($qsn[$i])."', scramble2_qsn='".escapeString($qsn[9+$i])."', scramble3_qsn='".escapeString($qsn[18+$i])."', scramble4_qsn='".escapeString($qsn[27+$i])."', scramble1_ans='".escapeString($ans[$i])."', scramble2_ans='".escapeString($ans[9+$i])."', scramble3_ans='".escapeString($ans[18+$i])."', scramble4_ans='".escapeString($ans[27+$i])."' WHERE ID='".($i+1)."'";
    mysqli_query($conn, $updateQsn);
       
}

?>