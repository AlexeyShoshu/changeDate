<?php

$dateCreate = '30-03-2023 15:12:12';
$pattern = "/^\d{2}[.-]\d{2}[.-]\d{4}\s\d{2}:\d{2}:\d{2}$/";

list($date, $time) = explode(" ", $dateCreate);

if (!stripos('.', $dateCreate)) {
    list($day, $month, $year) = explode("-", $date);
} else {
    list($day, $month, $year) = explode(".", $date);
}

list($hour, $minute, $second) = explode(":", $time);

$lastDayInMonth = date("t", strtotime($date));

function isLastDayInMonth(&$day, $lastDayInMonth, &$dateNew, &$month, $year)
{
    if (($day == $lastDayInMonth) && ($month != 12)) {
        $day = 0;
        $month++;
        $dateNew = implode(".", [$day, $month, $year]);
    }
}

function isLastDayInYear(&$day, $lastDayInMonth, &$dateNew, &$month, &$year)
{
    if (($day == $lastDayInMonth) && ($month == 12)) {
        $day = 0;
        $month = 1;
        $year++;
        $dateNew = implode(".", [$day, $month, $year]);
    }
}

function changeDate(&$day, $lastDayInMonth, &$dateNew, &$month, &$year) {
    isLastDayInMonth($day, $lastDayInMonth, $dateNew, $month, $year);
    isLastDayInYear($day, $lastDayInMonth, $dateNew, $month, $year);
    $day++;
    $dateNew = implode(".", [$day, $month, $year]);
    while ((date("l", strtotime($dateNew)) == 'Saturday') || (date("l", strtotime($dateNew)) == 'Sunday')) {
        isLastDayInMonth($day, $lastDayInMonth, $dateNew, $month, $year);
        isLastDayInYear($day, $lastDayInMonth, $dateNew, $month, $year);
        $day++;
        $dateNew = implode(".", [$day, $month, $year]);
    }
}


if ((!checkdate($month, $day, $year)) || (!preg_match($pattern, $dateCreate)) || (($hour < 0) || ($hour > 24)) || (($minute < 0) || ($minute > 59)) || (($second < 0) || ($second > 59))) {
    die("Дата '{$dateCreate}' не соответствует формату!");
}

if ($hour < 15) {
    changeDate($day, $lastDayInMonth, $dateNew, $month, $year);
} else {
    changeDate($day, $lastDayInMonth, $dateNew, $month, $year);
    changeDate($day, $lastDayInMonth, $dateNew, $month, $year);
}

if ($day <= 9) {
    $day = '0' . $day;
    $dateNew = implode(".", [$day, $month, $year]);
}
if (gettype($month) === 'integer') {
    $month = '0' . $month;
    $dateNew = implode(".", [$day, $month, $year]);
}

$dateResult = implode(" ", [$dateNew, $time]);

echo ($dateResult);
