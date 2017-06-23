<?php
require("phpMQTT.php");
	
$mqtt = new phpMQTT("www.km1.io", 1883, "phpMQTT Pub Example");
if(!$mqtt->connect(true,Null, $username = 'anakkapon', $password = 'ubgawoik')){
	exit(1);
}
$topics['/anakkapon/room507'] = array("qos"=>0, "function"=>"procmsg");
$mqtt->subscribe($topics,0);
while($mqtt->proc()){
		
}
$mqtt->close();
function procmsg($topic,$msg){
		echo "Msg Recieved: ".date("r")."\nTopic:{$topic}\n$msg\n";
}
	
?>
