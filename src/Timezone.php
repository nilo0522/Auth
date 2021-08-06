<?php

namespace FLigno\Auth;

use Carbon\Carbon;

class Timezone
{
    /**
     * @param  Carbon|null  $date
     * @param  null  $format
     * @param  bool  $format_timezone
     * @return string
     */
    public function convertToLocal(?Carbon $date, $format = null, $format_timezone = false) : string
    {
        if (is_null($date)) {
            return 'Empty';
        }
        $timezone = (auth('api')->user()->timezone) ?? config('app.timezone');
        
        if (!$format_timezone) {
        
            $date->setTimezone($timezone);
            
        }else{
           $date->setTimezone($format_timezone);
        }
       

        

        if (is_null($format)) {
            return $date->format(config('timezone.format'));
        }

        $formatted_date_time = $date->format($format);

        

        return $formatted_date_time;
    }

    /**
     * @param $date
     * @return Carbon
     */
    public function convertFromLocal($date) : Carbon
    {
        return Carbon::parse($date, auth()->user()->timezone)->setTimezone('UTC');
    }

    /**
     * @param  Carbon  $date
     * @return string
     */
    private function formatTimezone(Carbon $date) : string
    {
        $timezone = $date->format('e');
        $parts = explode('/', $timezone);

        if (count($parts) > 1) {
            return str_replace('_', ' ', $parts[1]) . ', ' . $parts[0];
        }

        return str_replace('_', ' ', $parts[0]);
    }
}
