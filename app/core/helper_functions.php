<?php 

function debugPrint($data) {
	echo '<pre>';
	print_r($data);
	echo '</pre>';
	return;
}

function getQueryParam($url, $param) {
    $queryString = parse_url($url, PHP_URL_QUERY);
    parse_str($queryString, $params);
    
    if (isset($params[$param])) {
        return $params[$param];
    }
    
    return null;
}

function isUrlValid($url) {
    $headers = @get_headers($url);
    
    if ($headers && false !== strpos($headers[0], '200')) {
        return true;
    }
    
    return false;
}

function removeTrailingSlash($url) {
    if (substr($url, -1) === '/') {
        $url = substr($url, 0, -1);  // Remove the last character (i.e., '/')
    }
    
    return $url;
}

function getCurrentPageUrl() {
    $url = '';

    if (isset($_SERVER['HTTPS']) && 'on' === $_SERVER['HTTPS']) {
        $url = "https://";
    } else {
        $url = "http://";
    }

    // Append the host (domain name, IP) to the URL.
    $url .= $_SERVER['HTTP_HOST'];

    // Append the requested resource location to the URL.
    $url .= $_SERVER['REQUEST_URI'];

    return $url;
}

function getUrlPath($url) {
    $urlParsed = parse_url($url);
    $urlPath = removeTrailingSlash( $urlParsed['path'] );

    return $urlPath;
}