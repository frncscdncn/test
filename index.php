<?php

require_once('./Route.php');

// Входящие данные
$flights = [
    [
        'from'    => 'VKO',
        'to'      => 'DME',
        'depart'  => '01.01.2020 12:44',
        'arrival' => '01.01.2020 13:44',
    ],
    [
        'from'    => 'DME',
        'to'      => 'JFK',
        'depart'  => '02.01.2020 23:00',
        'arrival' => '03.01.2020 11:44',
    ],
    [
        'from'    => 'DME',
        'to'      => 'HKT',
        'depart'  => '04.01.2020 13:40',
        'arrival' => '04.01.2020 22:22',
    ],
    [
        'from'    => 'HKT',
        'to'      => 'KZ',
        'depart'  => '05.01.2020 13:40',
        'arrival' => '05.01.2020 22:22',
    ],
];

$routes = new Route($flights);
$longestRoute = $routes->findLongestRouteByTime();

// Отображаем информацию по самому продолжительному маршруту.
foreach ($longestRoute as $key => $route) {
    echo $key+1 . ") " . $longestRoute[$key]['from'] . " → " . $longestRoute[$key]['to'] . "<br />время вылета: " . $longestRoute[$key]['depart'] . "<br />время прилета: " . $longestRoute[$key]['arrival'] . "<br/><br/>";

    if ($key == count($longestRoute)-1) {
        echo "Итого: c " . $longestRoute[0]['depart'] . " по " . end($longestRoute)['arrival'];
    }
}