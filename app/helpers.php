<?php

/* Template */
if (!function_exists('name'))
{
    // function here
}

if (!function_exists('convertRumbleVideosCountToInt'))
{
    function convertRumbleVideosCountToInt($rumbleVideosCount)
    {
        return intval(getFirstWord($rumbleVideosCount));
    }
}

if (!function_exists('convertRumbleFollowersCountToInt'))
{
    function convertRumbleFollowersCountToInt($rumbleFollowersCount) 
    {
        $word = getFirstWord($rumbleFollowersCount);
        $wordLen = strlen($word);
        $lastChar = $word[$wordLen-1];

        switch ($lastChar) {

            case 'M':
                $numericValue = floatval(rtrim($word, 'M'));
                return intval($numericValue * 1000000);

            case 'K':
                $numericValue = floatval(rtrim($word, 'K'));
                return intval($numericValue * 1000);

            default:
                return intval($word);
        }
    }
}

if (!function_exists('getFirstWord'))
{
    function getFirstWord($string) 
    {
        $words = explode(" ", $string);
        return $words[0];
    }
}

if (!function_exists('convertRumbleJoiningDateToMysqlDateFormat'))
{
    function convertRumbleJoiningDateToMysqlDateFormat($rumbleJoiningDate) 
    {
        // Remove the "Joined " part from the rumble joining date
        $dateString = str_replace("Joined ", "", $rumbleJoiningDate);

        // Parse the date string
        $dateTime = DateTime::createFromFormat('M d, Y', $dateString);

        // Format the date as MySQL format
        $mysqlDate = $dateTime->format('Y-m-d');

        return $mysqlDate;
    }
}

if (!function_exists('makeGetRequest'))
{
    function makeGetRequest($url) 
    {
        // Initialize cURL
        $curl = curl_init($url);
        
        // Set cURL options
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Return the response instead of printing it
        curl_setopt($curl, CURLOPT_HTTPGET, true); // Set the request method to GET

        // Execute the cURL request
        $response = curl_exec($curl);

        // Check for errors
        if ($response === false) return false;

        curl_close($curl);
        return $response;
    }
}

if (!function_exists('convertFromSlugFormatToOriginal'))
{
    function convertFromSlugFormatToOriginal($slugFormatStr)
    {
        // Split the string into an array of words
        $words = explode("-", $slugFormatStr); 

        // Capitalize the first letter of each word and join them with a space
        $convertedStr = implode(" ", array_map('ucfirst', $words));

        return $convertedStr;
    }
}

if (!function_exists('convertToSlugFormat'))
{

    function convertToSlugFormat($inputString)
    {
        // Trim leading and trailing spaces
        $trimmedString = trim($inputString);

        // Convert the trimmed string to lowercase
        $lowercaseString = strtolower($trimmedString);

        // Replace spaces with hyphens
        $outputString = str_replace(" ", "-", $lowercaseString);

        return $outputString;
    }
}