<?php

/**
 * 产生随机码
 *
 * @param type $codelen
 * @return string
 */
function creat_code($codelen = 4) {
    $code = '';
    $charset = "23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
    $charset_len = strlen($charset) - 1;
    for ($i = 0; $i < $codelen; $i++) {
        $code .= $charset[rand(1, $charset_len)];
    }
    return $code;
}

/**
 * 判断email格式是否正确
 * @param $email
 */
function is_email($email) {
    return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
}