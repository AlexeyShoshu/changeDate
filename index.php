<?php
$dateCreate = '09.06.2023 16:12:12';

if (empty(strtotime($dateCreate))) {
    die("Дата не соответствует формату!");
}

if ((int) date('G', strtotime($dateCreate)) < 15) {
    do {
        $dateCreate = date("d.m.Y G:i:s", strtotime("+1 day", strtotime($dateCreate)));
    } while ((date("l", strtotime($dateCreate)) == 'Saturday') || (date("l", strtotime($dateCreate)) == 'Sunday'));
} else {
    do {
        $dateCreate = date("d.m.Y G:i:s", strtotime("+1 day", strtotime($dateCreate)));
    } while ((date("l", strtotime($dateCreate)) == 'Saturday') || (date("l", strtotime($dateCreate)) == 'Sunday'));
    $dateCreate = date("d.m.Y G:i:s", strtotime("+1 day", strtotime($dateCreate)));
}

echo $dateCreate;

