<?php


$_POST['productinfo']=$_POST['ordertype'];

$_POST['surl']= "http://whitepanda.in/success.php";

$_POST['furl']="http://whitepanda.in/failure.php";

$_POST['service_provider']="payu_paisa";

$_POST['amount']=$_POST['quality'];

/*
    
echo $_POST['service_provider'];
echo $_POST['furl'];
echo $_POST['surl'];
echo $_POST['productinfo'];
echo $_POST['phone'];
echo $_POST['email'];
echo $_POST['firstname'];
echo $_POST['amount'];

*/

$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

$_POST['txnid']=$txnid;






                        // Merchant key here as provided by Payu
                        $MERCHANT_KEY = "IYjt2G";

$_POST['key']=$MERCHANT_KEY;
                        
                        // Merchant Salt as provided by Payu
                        $SALT = "lkXTUXtR";







                        
                        // End point - change to https://secure.payu.in for LIVE mode
                        $PAYU_BASE_URL = "https://secure.payu.in";
                        
                        $action = '';

                      


                        /*
                        if(empty($posted['txnid'])) {
                          // Generate random transaction id
                          $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
                        } else {
                          $txnid = $posted['txnid'];
                        }*/


                        $hash = '';
                        // Hash Sequence
                        $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";




$hashVarsSeq = explode('|', $hashSequence);
                            $hash_string = '';  
                            foreach($hashVarsSeq as $hash_var) {
                              $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
                              $hash_string .= '|';
                            }
                        
                            $hash_string .= $SALT;
                        
                        
                            $hash = strtolower(hash('sha512', $hash_string));
                            $action = $PAYU_BASE_URL . '/_payment';


$_POST['hash']=$hash;




  
                        $posted = array();

                        if(!empty($_POST)) {
                            //print_r($_POST);
                          foreach($_POST as $key => $value) {    
                            $posted[$key] = $value; 
                            
                          }
                        }
                        
                        $formError = 0;





                        if(empty($posted['hash']) && sizeof($posted) > 0) {
                          if(
                                  empty($posted['key'])
                                  || empty($posted['txnid'])
                                  || empty($posted['amount'])
                                  || empty($posted['firstname'])
                                  || empty($posted['email'])
                                  || empty($posted['phone'])
                                  || empty($posted['productinfo'])
                                  || empty($posted['surl'])
                                  || empty($posted['furl'])
                                  || empty($posted['service_provider'])
                          ) {
                            $formError = 1;
                          } else {
                            //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
                            $hashVarsSeq = explode('|', $hashSequence);
                            $hash_string = '';  
                            foreach($hashVarsSeq as $hash_var) {
                              $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
                              $hash_string .= '|';
                            }
                        
                            $hash_string .= $SALT;
                        
                        
                            $hash = strtolower(hash('sha512', $hash_string));
                            $action = $PAYU_BASE_URL . '/_payment';
                          }
                        } elseif(!empty($posted['hash'])) {
                            
                          $hash = $posted['hash'];
                          $action = $PAYU_BASE_URL . '/_payment';
                        }




?>
<form method="post" action="<?php echo $action; ?>" name="payuForm">
    
    
<input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
                              <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
                              <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />

<input type="hidden" name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? $name : $posted['firstname']; ?>" />

<input type="hidden" name="email" id="email" value="<?php echo (empty($posted['email'])) ? $_SESSION['username'] : $posted['email']; ?>" />

<input type='hidden' style="background-color:#2eb161; border:none; " name="phone" value="<?php echo (empty($posted['phone'])) ? $mobile : $posted['phone']; ?>" />

<textarea name="productinfo" style="display:none;"><?php echo (empty($posted['productinfo'])) ? $dataEntry3 : $posted['productinfo'] ?></textarea>

<input type="hidden" name="amount" id="product_name" value="<?php echo (empty($posted['amount'])) ? $quality: $posted['amount'] ?>" />

<input type="hidden" name="surl" value="<?php echo (empty($posted['surl'])) ? 'http://whitepanda.in/success.php' : $posted['surl'] ?>" size="64" />

<input type="hidden" name="furl" value="<?php echo (empty($posted['furl'])) ? 'http://whitepanda.in/failure.php' : $posted['furl'] ?>" size="64" />
<input type="hidden" name="service_provider" value="payu_paisa" size="64" />
<button type="submit">submit</button>
</form>