<?php
ob_start();
header('Access-Control-Allow-Origin: same-origin');
session_start();
require_once("user/protect.php");
require_once("config.php");
if ($masterkeymode==true){$apikey=$masterapikey;}else{$apikey=$_SESSION["user"]["user_apikey"];}

if (!isset($_POST['datafile']) || !file_exists($_POST['datafile'])) {
    echo "ERROR: Data file not provided or does not exist.";
    exit();
} 

require($_POST['datafile']);

$promptn = str_getcsv($promptnames, "\n");
$promptd = str_getcsv($promptdata, "\n");
$totalprompts=count($promptn);
if ($_POST['mode']==3){
    $i=0;
    $promptoutput="";
    foreach ($promptn as $promptname) {
        $promptoutput.="<option value=".$i.">".$promptname."</option>";
        $i++;
    }
    echo ($promptoutput);
    exit();
}
if (!isset($_POST['promptindex']) || !isset($_POST['mode'])){echo("ERROR"); exit();}
$promptindex=$_POST['promptindex'];
$prompt=$_POST['prompt'];
$prompt_name = $promptn[$promptindex];
$prompt_data = $promptd[$promptindex];

if ($_POST['mode']==1){
    echo ($prompt_data);
} else if ($_POST['mode']==2){
    //echo ($prompt_data);
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.openai.com/v1/images/generations',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{"prompt":"'.$prompt.'", "n":3, "size":"512x512"}',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$apikey,
        'Content-Type: application/json'
      ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);

    $json_array = json_decode(rtrim($response, "\0"), true);
    $data = $json_array['data'];
    echo json_encode($data);
} 
exit();
?>
