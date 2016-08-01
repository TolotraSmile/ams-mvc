<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 27/07/2016 17:40
 * Copyright etech consulting 2016
 */

if (!defined('AMS_USER_FUNC')) {
    define('AMS_USER_FUNC', 1);

    if (!function_exists('session_status')) {
        function session_status()
        {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
}