<?php

$to = "ashimrajkonwar@gmail.com";
$subject = "Order review";




$message = "Dear ".$fName." ".$lName.",<br>
You have placed an (Type of content) order on Whitepanda. Your order id is (Order number). Please find the details of the content you have ordered below.<br><br>



<table style='border: 1px solid black;'>
                        <tr>
                            <td>Catagory:</td>
                            <td><?php echo $orderName; ?></td>
                        </tr>
                        <tr>
                            <td>No. of Posts:</td>
                            <td><?php echo $noOfPosts; ?></td>
                        </tr>
                        <tr>
                            <td>Industry of experience:</td>
                            <td><?php echo $industry_of_experience; ?></td>
                        </tr>
                        <tr>
                            <td>Goal:</td>
                            <td><? echo emptycheck($goal); ?></td>
                        </tr>
                        <tr>
                            <td>Style of writing:</td>
                            <td><? echo emptycheck( $writingStyle); ?></td>
                        </tr>
                        <tr>
                            <td>Content Sample:</td>
                            <td><? echo emptycheck($sampleBlog); ?></td>
                        </tr>
                        <tr>
                            <td>Point Of View:</td>
                            <td><? echo emptycheck($pointsOfView); ?></td>
                        </tr>
                        <tr>
                            <td>Content Structure:</td>
                            <td><? echo emptycheck( $blogStructure); ?></td>
                        </tr>
                        <tr>
                            <td>Type of targeted audience:</td>
                            <td><? echo emptycheck($targetAudience); ?></td>
                        </tr>
                        <tr>
                            <td>Keypoints:</td>
                            <td><? echo emptycheck($keyPoints); ?></td>
                        </tr>
                        <tr>
                            <td>Things to avoid:</td>
                            <td><? echo emptycheck($thingsToAvoid); ?></td>
                        </tr>
                        <tr>
                            <td>Keywords:</td>
                            <td><? echo emptycheck($keywords); ?></td>
                        </tr>
                        <tr>
                            <td>Special Instructions:</td>
                            <td><? echo emptycheck($specialInstruct); ?></td>
                        </tr>
                    </table><br><br>
If you feel some changes need to be made to your order, feel free to mail us on support@whitepanda.in<br><br><br><br>
Regards<br>
Team White Panda";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: White Panda <whitepanda@business.com>' . "\r\n";

mail($to,$subject,$message,$headers);






?>