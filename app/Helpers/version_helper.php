<?php

if (!function_exists('get_api_version')) {
    function get_api_version () {
        preg_match("/orders\/(?<version>v\d)/", request()->route()->uri(), $match);
        return $match["version"] ?? config("orders.api.latest_version");
    }
}
