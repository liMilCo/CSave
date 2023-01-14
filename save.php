<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Config  ...
$config['logfilename'] = "data.txt"; //plase it next to this file and set permissions to 0777 #> data.txt => 0777

//Default; User: Admin & Pass: admin
$config['user'] = "admin";
$config['password'] = "21232f297a57a5a743894a0e4a801fc3"; //admin   //(For changing password encryption your key to MD5 Hash and replase hire)

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Start  ...
if($_REQUEST['s'] OR $_REQUEST['c']){   //this file accept and save content that use GET or Post [s] or [c] as content also [t] as title *Optional #> {LINK/save.php?t=title&c=content}
    $page = $SaveMode = true;
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////  Saving Mode //////////////////////////////////////////////
header("Access-Control-Allow-Origin: *");
    $title = $_REQUEST['t'];
    $textcontent = $_REQUEST['c'].$_REQUEST['s'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $date = date('Y/m/d - h:i:s A');
    $errorlog = "";

    $content = "(".$title.")[".$textcontent."]-<".$ip.">{".$date."};\n";

    $logcontents = file_get_contents($config['logfilename']);
    if(strpos($logcontents, $textcontent) !== false) {
        $errorlog = "Content alredy exist.";
    }else{
        $fp = fopen($config['logfilename'], 'a');
        if($fp){
            if(!fwrite($fp, $content)){
                $errorlog = "content not write on file.";
            }
            fclose($fp);

        }else{
            $errorlog = "access to log file denied.";

        }
    }
    if($errorlog){
         echo "{\"saved\":0,\"error\":1,\"log\":\"".$errorlog."\"}";
    }else{
        echo "{\"saved\":1,\"error\":0,\"log\":\"Content seved sucessfully.\",\"title\":\"".$title."\",\"content\":\"".$textcontent."\",\"ip\":\"".$ip."\",\"date\":\"".$date."\"}";
    }
    die();

}else{
    $page = $SaveMode = false;
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////  Show Mode //////////////////////////////////////////////

    if ($_SERVER['PHP_AUTH_USER'] != $config['user'] OR md5($_SERVER['PHP_AUTH_PW']) != $config['password']) {
        header('WWW-Authenticate: Basic realm="My Realm"');
        header('HTTP/1.0 401 Unauthorized');
        echo '<center style="color:red;"><h1>Access Denied</h1></center>';
    exit;
    die();
    }



if(isset($_REQUEST['cls'])){
    $fp = fopen($config['logfilename'], 'w');
    fwrite($fp, $content);
    fclose($fp);
    header("Location: ".$_SERVER['HTTP_REFERER']);//SCRIPT_URL  HTTP_REFERER
    die("<script>history.go(-1);</script>");
}
if(isset($_REQUEST['txt'])){
    header('Content-Type: text/plain');
    header('Content-Disposition: inline; filename="filename.txt"');
    readfile($config['logfilename']);
    die();
}


$fp = fopen($config['logfilename'], 'r');
while(!feof($fp)) {
    $content .= fgets($fp);
}
fclose($fp);
//echo "<a href='?logout'>LogOut</a> - ";
echo "<a href='?txt'>Open log</a> - ";
echo "<a href='javascript:cls();'>Clear log</a> <script>function cls(){if (confirm('Are you sure to destroy data forever ?')) {window.open('?cls', '_self');}} </script>";

echo "<br />";
echo "<textarea style='width: 80%; height: 440px;' >".$content."</textarea>";

}










?>