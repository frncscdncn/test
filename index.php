<?php

// $flights = [
//     [
//         'from'    => 'VKO',
//         'to'      => 'DME',
//         'depart'  => '01.01.2020 12:44',
//         'arrival' => '01.01.2020 13:44',
//     ],
//     [
//         'from'    => 'DME',
//         'to'      => 'JFK',
//         'depart'  => '02.01.2020 23:00',
//         'arrival' => '03.01.2020 11:44',
//     ],
//     [
//         'from'    => 'DME',
//         'to'      => 'HKT',
//         'depart'  => '01.01.2020 13:40',
//         'arrival' => '01.01.2020 22:22',
//     ],
// ];

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
    // [
    //     'from'    => 'HKT',
    //     'to'      => 'KZ',
    //     'depart'  => '10.01.2020 13:40',
    //     'arrival' => '10.01.2020 22:22',
    // ],
];



// создаем функцию поиска самого продолжительного маршрута
function findAndOutputTheLongestRouteByTime(array $flights) {
    $longestRoute = [];
    $longestRouteTime = 0;
  
    for ($i = 0; $i < count($flights); $i++) {
      $route = [$flights[$i]];
      $routeTime = getRouteTime($route);
  
      for ($j = 0; $j < count($flights); $j++) {
        if ($i === $j) continue;
  
        $nextFlight = $flights[$j];
        $firstFlight = $route[0];
        $lastFlight = end($route);
  
        if (
          $nextFlight['from'] === $lastFlight['to'] &&
          strtotime($nextFlight['depart']) >
            strtotime($lastFlight['arrival'])
        ) {
          $route[] = $nextFlight;
          $routeTime = getRouteTime($route);
          $j = -1;
        }


        if  ($nextFlight['to'] === $firstFlight['from'] && strtotime($nextFlight['arrival']) < strtotime($firstFlight['depart'])) {
            array_unshift($route, $nextFlight);
            $routeTime = getRouteTime($route);
            $j = -1;
        }
      }
  
      if ($routeTime > $longestRouteTime) {
        $longestRoute = $route;
        $longestRouteTime = $routeTime;
      }
    }

    // получаем кол-во часов в пути в самом продожительном маршруте, с учетом проведенного времени в транзитном аэропорту 
    $hours = floor(getRouteTime($longestRoute) / 60 / 60);

    // отображаем информацию по самому продолжительному маршруту
    foreach ($longestRoute as $key => $route) {
        echo $key+1 . ") " . $longestRoute[$key]['from'] . " → " . $longestRoute[$key]['to'] . "<br />время вылета: " . $longestRoute[$key]['depart'] . "<br />время прилета: " . $longestRoute[$key]['arrival'] . "<br/><br/>";

        if ($key == count($longestRoute)-1) {
            echo "Итого: c " . $longestRoute[0]['depart'] . " по " . end($longestRoute)['arrival'];
        }
    }
  }
  
  // функция возвращает общее время маршрута
  function getRouteTime(array $route) {
    $firstFlight = $route[0];
    $lastFlight = end($route);
  
    $firstFlightDepartureDate = strtotime($firstFlight['depart']);
    $lastFlightArrivalDate = strtotime($lastFlight['arrival']);
  
    return $lastFlightArrivalDate - $firstFlightDepartureDate;
  }

  // вызываем функцию по поиску самого продолжительного маршрута
  findAndOutputTheLongestRouteByTime($flights);