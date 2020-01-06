<?php
namespace Classes\Helpers\Converters;
class Distance
{

    public static function getDistance($lat1, $lon1, $lat2, $lon2, $radius)
    {
        $angle = $radius / 180;
        $lat1 /= $angle;
        $lon1 /= $angle;
        $lat2 /= $angle;
        $lon2 /= $angle;
        return rad2deg(acos(sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($lon1 - $lon2)))) * $angle;
    }
}

?>