<?php
	$mysqli = new mysqli('127.0.0.1', 'root', '', 'security');
	
	function getClientIP() {
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			return $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			return trim($ips[0]);
		} else {
			return $_SERVER['REMOTE_ADDR'];
		}
	}
	$user_ip = getClientIP();

	// Шаг 4: HttpOnly — недоступность для JS. Шаг 7: Secure — передача только по HTTPS
	setcookie("IP", $user_ip, [
		'expires' => time() + 3600,
		'path' => '/',
		'secure' => true,   // Передача только по HTTPS
		'httponly' => true  // Недоступность для JS
	]);
	setcookie("Datetime", date("Y-m-d H:i:s"), [
		'expires' => time() + 3600,
		'path' => '/',
		'secure' => true,   // Передача только по HTTPS
		'httponly' => true  // Недоступность для JS
	]);

	// Шаг 8: хранение данных авторизованного пользователя в COOKIES с обеспечением безопасности
	function setAuthCookie($userId) {
		setcookie("user", (string)$userId, [
			'expires' => time() + 3600 * 24 * 7,
			'path' => '/',
			'secure' => true,
			'httponly' => true
		]);
	}
	function getAuthUserId() {
		return isset($_COOKIE['user']) ? (int)$_COOKIE['user'] : -1;
	}
	function clearAuthCookie() {
		setcookie("user", "", [
			'expires' => time() - 3600,
			'path' => '/',
			'secure' => true,
			'httponly' => true
		]);
	}
?>
