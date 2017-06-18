<?php

namespace Models;

use mysqli;

class DB {

    private $servername, $dbname, $dbprefix, $username, $password, $conn;

    const USERTABLE = 'user';
    const BILLTABLE = 'bills';

    function __construct() {
        global $config;
        $this->servername = $config['db_server'];
        $this->dbname = $config['db_name'];
        $this->dbprefix = $config['db_prefix'];
        $this->username = $config['db_username'];
        $this->password = $config['db_password'];
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /*
     * Check if the login id has match, generate new one
     */

    public function check_login_id($login_id) {

        $query = $this->get_info(self::USERTABLE, 'login_id', 'login_id', $login_id);
        if (empty($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function set_user($id, $api_key, $collection_id, $x_signature, $login_id, $transaction_key, $md5_hash) {
        $sql = 'INSERT INTO ' . $this->dbprefix . self::USERTABLE . ' (`id`, `api_key`, `collection_id`, `x_signature`, `login_id`, `transaction_key`, `md5_hash`)'
                . " VALUES ('" . $id . "', '" . $api_key . "', '" . $collection_id . "', '" . $x_signature . "', '" . $login_id . "', '" . $transaction_key . "', '" . $md5_hash . "')";
        $result = $this->conn->query($sql);
        return $result;
    }

    /*
     * Find user/bills info (id,etc) based on table row and column
     */

    public function get_info($table, $what, $key = '', $value = '') {
        if (empty($key) && empty($value)) {
            $sql = "SELECT " . $what . " FROM " . $this->dbprefix . $table . " WHERE 1";
        } else {
            $sql = "SELECT " . $what . " FROM " . $this->dbprefix . $table . " WHERE " . $key . '="' . $value . '"';
        }
        $result = $this->conn->query($sql);

        /*
         * Prevent Unregistered User from using the system
         */
        if (!$result) {
            exit('Invalid X Login Value');
        }

        $id = $result->fetch_assoc();

        if ($what === '*' && !empty($id)) {
            return $id;
        } else if (empty($id[$what])) {
            return '';
        } else {
            return $id[$what];
        }
    }

    public function get_max_user_id() {

        $id = $this->get_info(self::USERTABLE, 'MAX(id)');
        if (empty($id)) {
            return '0';
        }
        return $id;
    }

    public function set_bill($bill_id, $order_id, $x_login, $relayURL) {
        $sql = 'INSERT INTO ' . $this->dbprefix . self::BILLTABLE . ' (`id`, `order_id`, `x_login`, `relayURL`, `timestamp`)'
                . " VALUES ('" . $bill_id . "', '" . $order_id . "', '" . $x_login . "', '" . $relayURL . "', '" . date("Y-m-d") . "')";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function get_timestamp($bill_id) {
        $timestamp = $this->get_info(self::BILLTABLE, 'timestamp', 'id', $bill_id);
        return $timestamp;
    }

    public function delete_bill($bill_id) {
        $sql = "DELETE FROM " . $this->dbprefix . self::BILLTABLE . " WHERE id= '" . $bill_id . "'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function get_bill_info($bill_id) {
        $all_info = $this->get_info(self::BILLTABLE, '*', 'id', $bill_id);
        return $all_info;
    }

    public function get_user_info($x_login) {
        $all_info = $this->get_info(self::USERTABLE, '*', 'login_id', $x_login);
        return $all_info;
    }

    public function get_transaction_key($x_login) {
        $transaction_key = $this->get_info(self::USERTABLE, 'transaction_key', 'login_id', $x_login);
        return $transaction_key;
    }

    public function get_md5_hash($x_login) {
        $md5_hash = $this->get_info(self::USERTABLE, 'md5_hash', 'login_id', $x_login);
        return $md5_hash;
    }

    public function get_x_sign($x_login) {
        $x_sign = $this->get_info(self::USERTABLE, 'x_signature', 'login_id', $x_login);
        return $x_sign;
    }

    public function get_x_login($bill_id) {
        $x_login = $this->get_info(self::BILLTABLE, 'x_login', 'id', $bill_id);
        return $x_login;
    }

    public function get_order_id($bill_id) {
        $order_id = $this->get_info(self::BILLTABLE, 'order_id', 'id', $bill_id);
        return $order_id;
    }

    public function get_relay_url($bill_id) {
        $relayURL = $this->get_info(self::BILLTABLE, 'relayURL', 'id', $bill_id);
        return $relayURL;
    }

    public function get_api_key($login_id) {
        $login_id = $this->get_info(self::USERTABLE, 'api_key', 'login_id', $login_id);
        return $login_id;
    }

    public function need_callback_update($bill_id, $status = 0) {
        $sql = 'UPDATE ' . $this->dbprefix . self::BILLTABLE . ' SET `need_callback` = "0" WHERE `id` = "' . $bill_id . '"';
        $result = $this->conn->query($sql);
        return $result;
    }

    public function get_need_callback($bill_id) {
        $need_callback = $this->get_info(self::BILLTABLE, 'need_callback', 'id', $bill_id);
        return $need_callback;
    }

    public function get_all_bill() {
        $sql = 'SELECT id, timestamp FROM ' . $this->dbprefix . self::BILLTABLE . ' WHERE 1';
        $result = $this->conn->query($sql);
        $array = [];
        while ($row = $result->fetch_assoc()) {
            array_push($array, $row);
        }
        return $array;
    }

}

/*
 * One variable/instantiation for usage of entire website
 * Prevent the need of multiple db class instantiation
 */
$db = new DB();
