<?php

/**
 * @param $text
 * @return bool|false|string|string[]|null
 */
function slugify($text)
{
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }
    return $text;
}


function setMessage($type, $message)
{
    session()->flash('type', $type);
    session()->flash('message', $message);
}


function randomColor($status)
{
    $color = [
        "pending" => "x-warning",
        "success" => "x-success",
        "return"  => "",
        "shipped" => "x-info"
    ];

    return $color[$status];
}


function orderStatus()
{
    $status = [
        "pending",
        "success",
        "return",
        "shipped"
    ];

    return $status;
}

function randomTitle($index)
{
    $title = [
        "0" => "Lorem ipsum, dolor sit amet",
        "1" => " consectetur adipisicing elit.",
        "2"  => " Quis, maxime dignissimos?",
        "3" => " Nisi culpa inventore incidunt",
        "4" => "voluptatum adipisci accusantium",
        "5" => "ipsum magnam laudantium excepturi",
    ];

    return $title[$index];
}

function randomContent($index)
{
    $content = [
        "0" => " Lorem ipsum, dolor sit ametLorem ipsum, dolor sit ametLorem ipsum, dolor sit ametLorem ipsum, dolor sit ametLorem ipsum, dolor sit amet",
        "1" => " consectetur adipisicing elit.Lorem ipsum, dolor sit amet.Lorem ipsum, dolor sit amet Lorem ipsum, dolor sit amet",
        "2"  => " Quis, maxime dignissimos? Lorem ipsum, dolor sit ametLorem ipsum, dolor sit ametLorem ipsum, dolor sit ametLorem ipsum, dolor sit amet",
        "3" => " Nisi culpa inventore inciduntLorem ipsum, dolor sit amet Lorem ipsum, dolor sit amet Lorem ipsum, dolor sit amet Lorem ipsum, dolor sit amet",
        "4" => "voluptatum adipisci accusantiumLorem ipsum, dolor sit amet Lorem ipsum, dolor sit amet Lorem ipsum, dolor sit amet Lorem ipsum, dolor sit amet",
        "5" => "ipsum magnam laudantium excepturiLorem ipsum, dolor sit amet Lorem ipsum, dolor sit amet Lorem ipsum, dolor sit amet Lorem ipsum, dolor sit amet",
    ];

    return $content[$index];
}

function randomName($index)
{
    $name = [
        "0" => "politics",
        "1" => "TECHNOLOGY",
        "2"  => "SPORTS",
        "3" => "TRAVEL",
        "4" => "STYLE",
        "5" => "HEALTH",
        "6" => "business",
    ];

    return $name[$index];
}