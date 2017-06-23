<?php
$client = new Mosquitto\Client();
$client->onConnect('connect');
$client->onDisconnect('disconnect');
$client->onSubscribe('subscribe');
$client->onMessage('message');
$client->connect("www.km1.io", 1883, 5);
$client->onLog('logger');
$client->subscribe('/anakkapon/room507', 1);
$client->loopForever();
function connect($r) {
	echo "I got code {$r}\n";
}
function subscribe() {
	echo "Subscribed to a topic\n";
}
function message($message) {
	printf("Got a message on topic %s with payload:\n%s\n", $message->topic, $message->payload);
}
function disconnect() {
	echo "Disconnected cleanly\n";
}
function logger() {
	var_dump(func_get_args());
}
