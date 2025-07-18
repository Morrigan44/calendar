<?php
// GET /relay.php?calendarId=...&key=...&start=...&end=...
header('Content-Type: application/json');

$calendarId = $_GET['calendarId'];
$apiKey     = $_GET['key'];
$start      = $_GET['start'];
$end        = $_GET['end'];

$url = "https://www.googleapis.com/calendar/v3/calendars/"
     . urlencode($calendarId)
     . "/events?key=" . urlencode($apiKey)
     . "&timeMin=" . urlencode($start)
     . "&timeMax=" . urlencode($end)
     . "&singleEvents=true&orderBy=startTime";

echo file_get_contents($url);
