<?php

require_once('plugins/login-password-less.php');

/**
 * Set allowed password
 * @param string result of password_hash
 */
return new AdminerLoginPasswordLess(password_hash('123456', PASSWORD_DEFAULT));