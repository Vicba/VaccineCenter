<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking confirmation</title>
</head>
<body>
    <h1>Booking confirmation</h1>

    <p>Your booking has been added to the system.</p>

    <ul>
        <li>Name: {{ $booking -> name }}</li>
        <li>Vaccine: {{ $vaccine -> name }}</li>
        <li>Date: {{ $booking -> date }}</li>
        <li>Allergies: {{ $booking -> allergies }}</li>
    </ul>
</body>
