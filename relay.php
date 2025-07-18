<?php
header("Content-Type: text/plain");
// Get params from URL
$calendarId = $_GET['calendarId'];
$apiKey = $_GET['key'];
$start = $_GET['start'];
$end = $_GET['end'];

$url = "https://www.googleapis.com/calendar/v3/calendars/$calendarId/events?key=$apiKey&timeMin=" . urlencode($start) . "&timeMax=" . urlencode($end) . "&singleEvents=true&orderBy=startTime";

$data = file_get_contents($url);
if (!$data) {
    http_response_code(500);
    echo "Could not fetch calendar.";
    exit;
}

$json = json_decode($data, true);
if (!isset($json['items'])) {
    echo "No events found.";
    exit;
}

foreach ($json['items'] as $event) {
    $summary = isset($event['summary']) ? $event['summary'] : '(No Title)';
    if (isset($event['start']['dateTime'])) {
        // Timed event
        $time = substr($event['start']['dateTime'], 11, 5); // "HH:MM"
    } else if (isset($event['start']['date'])) {
        // All-day event
        $time = "All Day";
    } else {
        $time = "??:??";
    }
    echo $time . " - " . $summary . "\n";
}
?>
