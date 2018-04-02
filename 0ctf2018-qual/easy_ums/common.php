<?php 
include "config.php";

function gen_task(){
	return bin2hex(file_get_contents('/dev/urandom', NULL, NULL, 0, 3));
}

function filter_phone($phone){
	return preg_match('/^[a-zA-Z0-9.]*$/', $phone);
}

function check_user($username){
	global $mysqli;
	$stmt = $mysqli->prepare("SELECT * FROM users WHERE username=?");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows === 0) return false;
	else return true;
}

function check_phone($phone){
	global $mysqli;
	if(!filter_phone($phone)) return false;
	$stmt = $mysqli->prepare("SELECT * FROM users WHERE phone=?");
	$stmt->bind_param("s", $phone);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows === 0) return false;
	else return true;
}

function register($username, $password, $phone){
	global $mysqli;
	if(strlen($username) > 16) return false;
	if(check_user($username)) return false;
	if(check_phone($phone)) return false;
	$password = md5($password);
	$stmt = $mysqli->prepare("INSERT INTO users(username, password, phone) VALUES(?, ?, ?)");
	$stmt->bind_param("sss", $username, $password, $phone);
	$stmt->execute();
	return $stmt->insert_id;
}

function login($username, $password){
	global $mysqli;
	$password = md5($password);
	$stmt = $mysqli->prepare("SELECT * FROM users WHERE username=? and password=?");
	$stmt->bind_param("ss", $username, $password);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows === 0) return false;
	$row = $result->fetch_assoc();
	$_SESSION['id'] = $row['id'];
	$_SESSION['username'] = $row['username'];
	$_SESSION['phone'] = $row['phone'];
	$_SESSION['verify'] = $row['verify'];
	return true;
}

function send_sms($phone, $msg){
	change_log($phone);
	$url = 'http://'.$phone.'/?'.$msg;
	$ch = curl_init((string)$url);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 3);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'HEAD');
	curl_setopt($ch, CURLOPT_TIMEOUT, 3);
	curl_setopt($ch, CURLOPT_NOBODY, 1);
	return curl_exec($ch);
}

function set_verify(){
	global $mysqli;
	$mysqli->query("UPDATE users SET verify=1 WHERE id=".$_SESSION['id']);
}

function unset_verify(){
	global $mysqli;
	$mysqli->query("UPDATE users SET verify=0 WHERE id=".$_SESSION['id']);
}

function check_verify(){
	if($_SESSION['verify'] !== 1){
		header("Location: verify.php");
		die();
	}
}

function update_phone($phone){
	if($_SESSION['id'] === 1) return false;
	global $mysqli;
	$stmt = $mysqli->prepare("UPDATE users SET phone=? WHERE id=?");
	$stmt->bind_param("si", $phone, $_SESSION['id']);
	$stmt->execute();
	return true;
}

function check_login(){
	if($_SESSION['id']) return true;
	else{
		header("Location: login.php");
		die();
	};
}

function generate_code($phone){
	global $flag;
	return md5(mt_rand().$flag.mt_rand().$phone);
}

function insert_code($phone, $code){
	global $mysqli;
	delete_code(); // !!!!
	$stmt = $mysqli->prepare("INSERT INTO tokens(uid, phone, token) VALUES(?, ?, ?)");
	$stmt->bind_param("iss",$_SESSION['id'], $phone, $code);
	$stmt->execute();
}

function delete_code(){
	global $mysqli;
	$stmt = $mysqli->prepare("DELETE FROM tokens WHERE uid=?");
	$stmt->bind_param("i", $_SESSION['id']);
	$stmt->execute();
}

function check_code($phone, $code){
	global $mysqli;
	$stmt = $mysqli->prepare("SELECT * FROM tokens WHERE phone=? and token=? and uid=?");
	$stmt->bind_param("ssi", $phone, $code,  $_SESSION['id']);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows === 0) return false;
	else return true;
}

function change_log($phone){
	global $mysqli;
	$stmt = $mysqli->prepare("INSERT INTO change_log(uid, phone, ip) VALUES(?, ?, ?)");
	$stmt->bind_param("iss",$_SESSION['id'], $phone, $_SERVER['REMOTE_ADDR']);
	$stmt->execute();
}

function get_flag(){
	global $mysqli;
	$stmt = $mysqli->prepare("SELECT * FROM users WHERE id=?");
	$stmt->bind_param("i", $_SESSION['id']);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows === 0) return false;
	$row = $result->fetch_assoc();
	if($row['phone'] === '8.8.8.8' && $row['verify'] === 1){
		return true;
	}
}
