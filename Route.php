<?php

class Route
{
    private array $flights;
    private array $allPermutationOptionsFlights;

    public function __construct (array $flights)
    {
        // При инициализации объекта помещаем массив рейсов в определенный атрибут $this->flights.
        $this->flights = $flights;
        
        // При инициализации объекта запускаем приватный метод перебора массива рейсов во все возможные порядки последовательности,
        // для дальнейшего корректного поиска самого продолжительного маршрута.
        $this->permutationRoutes($this->flights);
    }

    // Публичный метод, для изменения входящих данных (массива с рейсами), необходимо заметить что в данном случае мы отчищаем приватный атрибут
    // $this->$allPermutationOptionsFlights посредством его сеттера $this->setAllPermutationOptionsFlights(),
    // и далее вызываем приватный метод $this->permutationRoutes(array $routes) как и при инициализации объекта.
    public function setFlights (array $flights): void
    {
        $this->flights = $flights;
        $this->setAllPermutationOptionsFlights();
        $this->permutationRoutes($flights);
    }
    
    public function getFlights (): array
    {
        return $this->flights;
    }
    
    private function setAllPermutationOptionsFlights (array $flights = []): void
    {
        (count($flights)) ? $this->allPermutationOptionsFlights[] = $flights : $this->allPermutationOptionsFlights = $flights;
    }
    
    public function getAllPermutationOptionsFlights (): array
    {
        return $this->allPermutationOptionsFlights;
    }

    // Приватный метод перебирает массив рейсов во все возможные порядки последовательности,
    // для дальнейшего корректного поиска самого продолжительного маршрута.
    private function permutationRoutes ($routes, $perms = []): void
    {
        if (empty($routes)) {
            $this->setAllPermutationOptionsFlights($perms);
        }
        for ($i = 0; $i < count($routes); $i++) {
            $newRoutes = $routes;
            $newPerms = $perms;
            list($foo) = array_splice($newRoutes, $i, 1);
            array_unshift($newPerms, $foo);
            $this->permutationRoutes($newRoutes, $newPerms);
        }
    }

    // Приватный метод возвращает общую длительность маршрута в часах, с учетом проведенного времени в транзитном аэропорту.
    private function getRouteTime (array $routes): float
    {
        $firstFlight = $routes[0];
        $lastFlight = end($routes);
    
        $firstFlightDepartureDate = strtotime($firstFlight['depart']);
        $lastFlightArrivalDate = strtotime($lastFlight['arrival']);

        return floor(($lastFlightArrivalDate - $firstFlightDepartureDate) / 60 / 60);
    }

    // Публичный метод возвращяет самый продолжительный маршрут.
    public function findLongestRouteByTime(): array
    {
        $longestRoute = [];
        $longestRouteTime = 0;
        $allRouts = [];

        $allPermutationOptionsFlights = $this->getAllPermutationOptionsFlights();

        foreach ($allPermutationOptionsFlights as $flights) {
            for ($i = 0; $i < count($flights); $i++) {
              $route = [$flights[$i]];
              $routeTime = $this->getRouteTime($route);
          
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
                    $routeTime = $this->getRouteTime($route);
                    $j = -1;
                    }
            
            
                    if  ($nextFlight['to'] === $firstFlight['from'] && strtotime($nextFlight['arrival']) < strtotime($firstFlight['depart'])) {
                        array_unshift($route, $nextFlight);
                        $routeTime = $this->getRouteTime($route);
                        $j = -1;
                    }
                }
            }
      
            if ($routeTime > $longestRouteTime) {
            $longestRoute = $route;
            $longestRouteTime = $routeTime;
            }

            $allRouts[] = $route;
        }

        return $longestRoute;
    }
}
