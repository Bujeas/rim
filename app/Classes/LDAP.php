<?php

namespace App\Classes\LDAP;

class LDAP {

	private static $_conn;

	// private functions
	private static function connect($credential)
	{
		$ldapconn = ldap_connect($credential['host'], $credential['port']) or die("Could not connect to LDAP server.");
		ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);

		return $ldapconn;
	}


	// public functions
	public static function bind($credential)
	{
		$ldapconn = self::connect($credential);
		self::$_conn = $ldapconn;

		try {
			// binding to ldap server
		    $ldapbind = ldap_bind($ldapconn, $credential['userid'], $credential['password']);
		    if ($ldapbind) {
		    	// debug('1: '.$ldapbind);
		        return $ldapbind;
		    }

		} catch (\Exception $e) {
			return false;
		}
	}

	public static function login($email, $password) 
	{
		// $exemail = explode('@', $email);
		// $ldap_account = 'prasarana\\' . $exemail[0];
		$sAMAccountName = self::search_samaccountname($email);
		$ldap_account = 'prasarana\\' . $sAMAccountName;
		$credential = array(
			'host' 		=> LDAP_HOST,
			'port' 		=> LDAP_PORT,
			'userid' 	=> $ldap_account,
			'password' 	=> $password
		);

		try {
			$ldapbind = self::bind($credential);
			// debug('--- '.$ldapbind);
			// $ldapconn = self::connect($credential);
			// $ldapbind = ldap_bind($ldapconn, $credential['userid'], $credential['password']);
		    if ($ldapbind) {
		    	// debug('2: masuk');
		    	return $credential;
		    }else{
		    	return 'B';
		    }

		} catch (\Exception $e) {
			// debug($e);
			// return false;
			return 'B';
		}
		return false;
	}

	public static function search($filter, $attributes) 
	{
		$credential = array(
			'host' 		=> LDAP_HOST,
			'port' 		=> LDAP_PORT,
			'userid' 	=> LDAP_USER,
			'password' 	=> LDAP_PASS
		);

		$base_dn = 'DC=Prasarana,DC=com,DC=my';
		$pageSize = 1000;
		$results = array();
		$cookie = '';

		try {

			$ldapbind = self::bind($credential);
		    if ($ldapbind) {
		    	$cookie = '';
			    do {
			    	ldap_control_paged_result(self::$_conn, $pageSize, true, $cookie);
		        	$result = ldap_search(self::$_conn, $base_dn, $filter, $attributes);
					$entries = ldap_get_entries(self::$_conn, $result);
					// debug($entries);

					foreach ($entries as $e) {
						array_push($results, $e);
					}

					ldap_control_paged_result_response(self::$_conn, $result, $cookie);

				} while($cookie !== null && $cookie != '');

				return $results;
		    }

		} catch (\Exception $e) {
			debug($e);
			// echo 'Connection Error.';
			return 'C';
		}

		return false;
	}

	public static function search_employees() 
	{
		// $filter = '(&(objectCategory=person)(sAMAccountName=khairulnizam.dahari))';
		$filter = '(&(objectCategory=person)(mail=*))';
		// $attributes = array('sAMAccountName', 'mail');
		$attributes = array('name', 'mail');
		$results = self::search($filter, $attributes);

		$array = array();
		$tmpEmail = array();
		$i = 0;
		foreach ($results as $key => $result) {
			$name = trim($result['name'][0]);
			$mail = strtolower(trim($result['mail'][0]));
			if(is_array($result) && array_key_exists('mail', $result) && !in_array($mail, $tmpEmail)) {
				//debug($email['mail'][0]);
				$array[$i]['mail'] = $mail;
				$array[$i]['name'] = $name;
				$tmpEmail[$i] = $mail;
				$i++;
			}
		}
		return $array;
	}

	public static function search_samaccountname($email = '') 
	{
		$filter = '(&(objectCategory=person)(mail='.$email.'))';
		$attributes = array('sAMAccountName');
		$results = self::search($filter, $attributes);
		// debug($results);
		if ($results) {
			$sAMAccountName = '';
			$i = 0;
			foreach ($results as $key => $result) {
				$sAMAccountName = strtolower(trim($result['samaccountname'][0]));
			}
			// debug($sAMAccountName);
			return $sAMAccountName;
		} else {
			return false;
		}
	}

	public static function employees_email() 
	{
		$filter = '(&(objectCategory=person)(mail=*))';
		$attributes = array('name', 'mail');
		$results = self::search($filter, $attributes);

		$array = array();
		$i = 0;
		foreach ($results as $key => $result) {
			if(is_array($result) && array_key_exists('mail', $result)) {
				$array[$i]['id'] = $key;
				$array[$i]['name'] = $result['mail'][0];
				$i++;
			}
		}
		return $array;
	}


}