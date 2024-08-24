<?php
function getRoadDistance($lat1, $lon1, $lat2, $lon2)
{
    $apiKey = '5b3ce3597851110001cf624807fa0e0cc0c34f3f952b2f2bcb2b7227';
    $url = "https://api.openrouteservice.org/v2/directions/driving-car?api_key=$apiKey&start=$lon1,$lat1&end=$lon2,$lat2";

    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if (isset($data['features'][0]['properties']['segments'][0]["distance"])) {
        // Distance in meters
        $distanceMeters = $data['features'][0]['properties']['segments'][0]["distance"];
        // Convert to kilometers
        $distanceKm = $distanceMeters / 1000;
        // Round to 2 decimal places
        return round($distanceKm, 2);
    } else {
        return false; // Handle error
    }
}
?>
