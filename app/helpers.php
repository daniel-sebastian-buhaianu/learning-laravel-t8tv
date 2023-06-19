<?php

/* Template */
if (!function_exists('name'))
{
    // function here
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