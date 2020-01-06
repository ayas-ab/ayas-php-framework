<?php
namespace Classes\Helpers\Converters;

class Dates
{
    //returns the if of a given day. usage: DayToID('monday')
    public static function DayToId(string $day_name): string
    {
        return date('N', strtotime($day_name));
    }

    public static function getDateTime()
    {
        return date("Y-m-d H:i:s");
    }
    
    //coverts any date time format to a db readable date time.
    public static function string_to_datetime(string $val)
    {
        return date('Y-m-d H:i:s', strtotime($val));
    }

    //converts integer timestamp to a date time string.
    public static function timestampToDateTime(int $timestamp): string
    {
        $server_dateTime = new \DateTime();
        $server_dateTime->setTimestamp($timestamp);
        return $server_dateTime->format('Y-m-d H:i:s');
    }
}