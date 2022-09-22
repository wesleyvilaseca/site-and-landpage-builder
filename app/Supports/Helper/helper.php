<?php

function isBase64Encoded(string $s): bool
{
    if ((bool) preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $s) === false) {
        return false;
    }
    $decoded = base64_decode($s, true);
    if ($decoded === false) {
        return false;
    }
    $encoding = mb_detect_encoding($decoded);
    if (!in_array($encoding, ['UTF-8', 'ASCII'], true)) {
        return false;
    }
    return $decoded !== false && base64_encode($decoded) === $s;
}

function is_base64($s)
{
    return (bool) preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $s);
}

function back_route_pagebuilder()
{
    $id = @$_GET['site_id'] ? $_GET['site_id'] : 0;
    $route = '/settings/website/' . $id;
    return $route;
}

function get_site_url()
{
    return url('/');
}

function getasset($route)
{
    return asset($route);
}