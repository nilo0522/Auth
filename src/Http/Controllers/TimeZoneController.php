<?php

namespace Fligno\Auth\Http\Controllers;

use Illuminate\Http\Request;
use Fligno\Auth\Models\Setting;
use Config;
use Artisan;
use Fligno\Auth\Models\UserTimeZone;
use App\Models\User;
use Timezone;
class TimeZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $time_zone = Setting::where('setting','TimeZone')->count();
        if($time_zone>0)
        {
            
        $time_zone = Setting::where('setting','TimeZone')->first();
            $attr = json_decode($time_zone->attr);
            $timezone_date = auth('api')->user()->timezone." ".Timezone::convertToLocal(now());
            return response()->json(['attr'=> $attr, 'timezone' => auth('api')->user()->timezone,'date'=>$timezone_date]);

        }else
        {
        $setting = new Setting;
          $setting -> setting ="TimeZone";
          $setting -> value = auth('api')->user()->timezone;
        $setting->attr = json_encode([
            "option" => [
                ["value" => "Pacific/Midway","label" => "(GMT-11:00) Pacific/Midway"],
                ["value" => "Pacific/Pago_Pago","label" => "(GMT-11:00) Pacific/Pago_Pago"],
                ["value" => "Pacific/Niue","label" => "(GMT-11:00) Pacific/Niue"],
                ["value" => "America/Adak","label" => "(GMT-10:00) America/Adak"],
                ["value" => "Pacific/Tahiti","label" => "(GMT-10:00) Pacific/Tahiti"],
                ["value" => "Pacific/Rarotonga","label" => "(GMT-10:00) Pacific/Rarotonga"],
                ["value" => "Pacific/Honolulu","label" => "(GMT-10:00) Pacific/Honolulu"],
                ["value" => "Pacific/Marquesas","label" => "(GMT-09:30) Pacific/Marquesas"],
                ["value" => "America/Sitka","label" => "(GMT-09:00) America/Sitka"],
                ["value" => "Pacific/Gambier","label" => "(GMT-09:00) Pacific/Gambier"],
                ["value" => "America/Yakutat","label" => "(GMT-09:00) America/Yakutat"],
                ["value" => "America/Juneau","label" => "(GMT-09:00) America/Juneau"],
                ["value" => "America/Nome","label" => "(GMT-09:00) America/Nome"],
                ["value" => "America/Anchorage","label" => "(GMT-09:00) America/Anchorage"],
                ["value" => "America/Metlakatla","label" => "(GMT-09:00) America/Metlakatla"],
                ["value" => "America/Los_Angeles","label" => "(GMT-08:00) America/Los_Angeles"],
                ["value" => "America/Tijuana","label" => "(GMT-08:00) America/Tijuana"],
                ["value" => "America/Whitehorse","label" => "(GMT-08:00) America/Whitehorse"],
                ["value" => "America/Vancouver","label" => "(GMT-08:00) America/Vancouver"],
                ["value" => "America/Dawson","label" => "(GMT-08:00) America/Dawson"],
                ["value" => "Pacific/Pitcairn","label" => "(GMT-08:00) Pacific/Pitcairn"],
                ["value" => "America/Mazatlan","label" => "(GMT-07:00) America/Mazatlan"],
                ["value" => "America/Fort_Nelson","label" => "(GMT-07:00) America/Fort_Nelson"],
                ["value" => "America/Yellowknife","label" => "(GMT-07:00) America/Yellowknife"],
                ["value" => "America/Inuvik","label" => "(GMT-07:00) America/Inuvik"],
                ["value" => "America/Edmonton","label" => "(GMT-07:00) America/Edmonton"],
                ["value" => "America/Denver","label" => "(GMT-07:00) America/Denver"],
                ["value" => "America/Chihuahua","label" => "(GMT-07:00) America/Chihuahua"],
                ["value" => "America/Boise","label" => "(GMT-07:00) America/Boise"],
                ["value" => "America/Ojinaga","label" => "(GMT-07:00) America/Ojinaga"],
                ["value" => "America/Cambridge_Bay","label" => "(GMT-07:00) America/Cambridge_Bay"],
                ["value" => "America/Dawson_Creek","label" => "(GMT-07:00) America/Dawson_Creek"],
                ["value" => "America/Phoenix","label" => "(GMT-07:00) America/Phoenix"],
                ["value" => "America/Hermosillo","label" => "(GMT-07:00) America/Hermosillo"],
                ["value" => "America/Creston","label" => "(GMT-07:00) America/Creston"],
                ["value" => "America/Matamoros","label" => "(GMT-06:00) America/Matamoros"],
                ["value" => "America/Menominee","label" => "(GMT-06:00) America/Menominee"],
                ["value" => "America/Indiana/Knox","label" => "(GMT-06:00) America/Indiana/Knox"],
                ["value" => "America/Managua","label" => "(GMT-06:00) America/Managua"],
                ["value" => "America/Bahia_Banderas","label" => "(GMT-06:00) America/Bahia_Banderas"],
                ["value" => "America/Indiana/Tell_City","label" => "(GMT-06:00) America/Indiana/Tell_City"],
                ["value" => "America/Belize","label" => "(GMT-06:00) America/Belize"],
                ["value" => "America/Chicago","label" => "(GMT-06:00) America/Chicago"],
                ["value" => "America/Guatemala","label" => "(GMT-06:00) America/Guatemala"],
                ["value" => "America/El_Salvador","label" => "(GMT-06:00) America/El_Salvador"],
                ["value" => "America/Merida","label" => "(GMT-06:00) America/Merida"],
                ["value" => "America/Costa_Rica","label" => "(GMT-06:00) America/Costa_Rica"],
                ["value" => "America/Mexico_City","label" => "(GMT-06:00) America/Mexico_City"],
                ["value" => "America/Winnipeg","label" => "(GMT-06:00) America/Winnipeg"],
                ["value" => "Pacific/Galapagos","label" => "(GMT-06:00) Pacific/Galapagos"],
                ["value" => "America/Resolute","label" => "(GMT-06:00) America/Resolute"],
                ["value" => "America/Regina","label" => "(GMT-06:00) America/Regina"],
                ["value" => "America/Rankin_Inlet","label" => "(GMT-06:00) America/Rankin_Inlet"],
                ["value" => "America/Rainy_River","label" => "(GMT-06:00) America/Rainy_River"],
                ["value" => "America/North_Dakota/New_Salem","label" => "(GMT-06:00) America/North_Dakota/New_Salem"],
                ["value" => "America/North_Dakota/Beulah","label" => "(GMT-06:00) America/North_Dakota/Beulah"],
                ["value" => "America/North_Dakota/Center","label" => "(GMT-06:00) America/North_Dakota/Center"],
                ["value" => "America/Tegucigalpa","label" => "(GMT-06:00) America/Tegucigalpa"],
                ["value" => "America/Swift_Current","label" => "(GMT-06:00) America/Swift_Current"],
                ["value" => "America/Monterrey","label" => "(GMT-06:00) America/Monterrey"],
                ["value" => "America/Pangnirtung","label" => "(GMT-05:00) America/Pangnirtung"],
                ["value" => "America/Indiana/Petersburg","label" => "(GMT-05:00) America/Indiana/Petersburg"],
                ["value" => "America/Indiana/Marengo","label" => "(GMT-05:00) America/Indiana/Marengo"],
                ["value" => "America/Bogota","label" => "(GMT-05:00) America/Bogota"],
                ["value" => "America/Toronto","label" => "(GMT-05:00) America/Toronto"],
                ["value" => "America/Detroit","label" => "(GMT-05:00) America/Detroit"],
                ["value" => "America/Panama","label" => "(GMT-05:00) America/Panama"],
                ["value" => "America/Cancun","label" => "(GMT-05:00) America/Cancun"],
                ["value" => "America/Rio_Branco","label" => "(GMT-05:00) America/Rio_Branco"],
                ["value" => "America/Port-au-Prince","label" => "(GMT-05:00) America/Port-au-Prince"],
                ["value" => "America/Cayman","label" => "(GMT-05:00) America/Cayman"],
                ["value" => "America/Grand_Turk","label" => "(GMT-05:00) America/Grand_Turk"],
                ["value" => "America/Havana","label" => "(GMT-05:00) America/Havana"],
                ["value" => "America/Indiana/Indianapolis","label" => "(GMT-05:00) America/Indiana/Indianapolis"],
                ["value" => "America/Indiana/Vevay","label" => "(GMT-05:00) America/Indiana/Vevay"],
                ["value" => "America/Guayaquil","label" => "(GMT-05:00) America/Guayaquil"],
                ["value" => "America/Nipigon","label" => "(GMT-05:00) America/Nipigon"],
                ["value" => "America/Indiana/Vincennes","label" => "(GMT-05:00) America/Indiana/Vincennes"],
                ["value" => "America/Atikokan","label" => "(GMT-05:00) America/Atikokan"],
                ["value" => "America/Indiana/Winamac","label" => "(GMT-05:00) America/Indiana/Winamac"],
                ["value" => "America/New_York","label" => "(GMT-05:00) America/New_York"],
                ["value" => "America/Iqaluit","label" => "(GMT-05:00) America/Iqaluit"],
                ["value" => "America/Jamaica","label" => "(GMT-05:00) America/Jamaica"],
                ["value" => "America/Nassau","label" => "(GMT-05:00) America/Nassau"],
                ["value" => "America/Kentucky/Louisville","label" => "(GMT-05:00) America/Kentucky/Louisville"],
                ["value" => "America/Kentucky/Monticello","label" => "(GMT-05:00) America/Kentucky/Monticello"],
                ["value" => "America/Eirunepe","label" => "(GMT-05:00) America/Eirunepe"],
                ["value" => "Pacific/Easter","label" => "(GMT-05:00) Pacific/Easter"],
                ["value" => "America/Lima","label" => "(GMT-05:00) America/Lima"],
                ["value" => "America/Thunder_Bay","label" => "(GMT-05:00) America/Thunder_Bay"],
                ["value" => "America/Guadeloupe","label" => "(GMT-04:00) America/Guadeloupe"],
                ["value" => "America/Manaus","label" => "(GMT-04:00) America/Manaus"],
                ["value" => "America/Guyana","label" => "(GMT-04:00) America/Guyana"],
                ["value" => "America/Halifax","label" => "(GMT-04:00) America/Halifax"],
                ["value" => "America/Puerto_Rico","label" => "(GMT-04:00) America/Puerto_Rico"],
                ["value" => "America/Porto_Velho","label" => "(GMT-04:00) America/Porto_Velho"],
                ["value" => "America/Port_of_Spain","label" => "(GMT-04:00) America/Port_of_Spain"],
                ["value" => "America/Montserrat","label" => "(GMT-04:00) America/Montserrat"],
                ["value" => "America/Moncton","label" => "(GMT-04:00) America/Moncton"],
                ["value" => "America/Martinique","label" => "(GMT-04:00) America/Martinique"],
                ["value" => "America/Kralendijk","label" => "(GMT-04:00) America/Kralendijk"],
                ["value" => "America/La_Paz","label" => "(GMT-04:00) America/La_Paz"],
                ["value" => "America/Marigot","label" => "(GMT-04:00) America/Marigot"],
                ["value" => "America/Lower_Princes","label" => "(GMT-04:00) America/Lower_Princes"],
                ["value" => "America/Grenada","label" => "(GMT-04:00) America/Grenada"],
                ["value" => "America/Santo_Domingo","label" => "(GMT-04:00) America/Santo_Domingo"],
                ["value" => "America/Goose_Bay","label" => "(GMT-04:00) America/Goose_Bay"],
                ["value" => "America/Caracas","label" => "(GMT-04:00) America/Caracas"],
                ["value" => "America/Anguilla","label" => "(GMT-04:00) America/Anguilla"],
                ["value" => "America/St_Barthelemy","label" => "(GMT-04:00) America/St_Barthelemy"],
                ["value" => "America/Barbados","label" => "(GMT-04:00) America/Barbados"],
                ["value" => "America/St_Kitts","label" => "(GMT-04:00) America/St_Kitts"],
                ["value" => "America/Blanc-Sablon","label" => "(GMT-04:00) America/Blanc-Sablon"],
                ["value" => "America/Boa_Vista","label" => "(GMT-04:00) America/Boa_Vista"],
                ["value" => "America/St_Lucia","label" => "(GMT-04:00) America/St_Lucia"],
                ["value" => "America/St_Thomas","label" => "(GMT-04:00) America/St_Thomas"],
                ["value" => "America/Antigua","label" => "(GMT-04:00) America/Antigua"],
                ["value" => "America/St_Vincent","label" => "(GMT-04:00) America/St_Vincent"],
                ["value" => "America/Thule","label" => "(GMT-04:00) America/Thule"],
                ["value" => "America/Curacao","label" => "(GMT-04:00) America/Curacao"],
                ["value" => "America/Tortola","label" => "(GMT-04:00) America/Tortola"],
                ["value" => "America/Dominica","label" => "(GMT-04:00) America/Dominica"],
                ["value" => "Atlantic/Bermuda","label" => "(GMT-04:00) Atlantic/Bermuda"],
                ["value" => "America/Glace_Bay","label" => "(GMT-04:00) America/Glace_Bay"],
                ["value" => "America/Aruba","label" => "(GMT-04:00) America/Aruba"],
                ["value" => "America/St_Johns","label" => "(GMT-03:30) America/St_Johns"],
                ["value" => "America/Argentina/Tucuman","label" => "(GMT-03:00) America/Argentina/Tucuman"],
                ["value" => "America/Belem","label" => "(GMT-03:00) America/Belem"],
                ["value" => "America/Santiago","label" => "(GMT-03:00) America/Santiago"],
                ["value" => "America/Santarem","label" => "(GMT-03:00) America/Santarem"],
                ["value" => "America/Recife","label" => "(GMT-03:00) America/Recife"],
                ["value" => "America/Punta_Arenas","label" => "(GMT-03:00) America/Punta_Arenas"],
                ["value" => "Atlantic/Stanley","label" => "(GMT-03:00) Atlantic/Stanley"],
                ["value" => "America/Paramaribo","label" => "(GMT-03:00) America/Paramaribo"],
                ["value" => "America/Fortaleza","label" => "(GMT-03:00) America/Fortaleza"],
                ["value" => "America/Argentina/San_Luis","label" => "(GMT-03:00) America/Argentina/San_Luis"],
                ["value" => "Antarctica/Palmer","label" => "(GMT-03:00) Antarctica/Palmer"],
                ["value" => "America/Montevideo","label" => "(GMT-03:00) America/Montevideo"],
                ["value" => "America/Cuiaba","label" => "(GMT-03:00) America/Cuiaba"],
                ["value" => "America/Miquelon","label" => "(GMT-03:00) America/Miquelon"],
                ["value" => "America/Cayenne","label" => "(GMT-03:00) America/Cayenne"],
                ["value" => "America/Campo_Grande","label" => "(GMT-03:00) America/Campo_Grande"],
                ["value" => "Antarctica/Rothera","label" => "(GMT-03:00) Antarctica/Rothera"],
                ["value" => "America/Godthab","label" => "(GMT-03:00) America/Godthab"],
                ["value" => "America/Bahia","label" => "(GMT-03:00) America/Bahia"],
                ["value" => "America/Asuncion","label" => "(GMT-03:00) America/Asuncion"],
                ["value" => "America/Argentina/Ushuaia","label" => "(GMT-03:00) America/Argentina/Ushuaia"],
                ["value" => "America/Argentina/La_Rioja","label" => "(GMT-03:00) America/Argentina/La_Rioja"],
                ["value" => "America/Araguaina","label" => "(GMT-03:00) America/Araguaina"],
                ["value" => "America/Argentina/Buenos_Aires","label" => "(GMT-03:00) America/Argentina/Buenos_Aires"],
                ["value" => "America/Argentina/Rio_Gallegos","label" => "(GMT-03:00) America/Argentina/Rio_Gallegos"],
                ["value" => "America/Argentina/Catamarca","label" => "(GMT-03:00) America/Argentina/Catamarca"],
                ["value" => "America/Maceio","label" => "(GMT-03:00) America/Maceio"],
                ["value" => "America/Argentina/San_Juan","label" => "(GMT-03:00) America/Argentina/San_Juan"],
                ["value" => "America/Argentina/Salta","label" => "(GMT-03:00) America/Argentina/Salta"],
                ["value" => "America/Argentina/Mendoza","label" => "(GMT-03:00) America/Argentina/Mendoza"],
                ["value" => "America/Argentina/Cordoba","label" => "(GMT-03:00) America/Argentina/Cordoba"],
                ["value" => "America/Argentina/Jujuy","label" => "(GMT-03:00) America/Argentina/Jujuy"],
                ["value" => "Atlantic/South_Georgia","label" => "(GMT-02:00) Atlantic/South_Georgia"],
                ["value" => "America/Noronha","label" => "(GMT-02:00) America/Noronha"],
                ["value" => "America/Sao_Paulo","label" => "(GMT-02:00) America/Sao_Paulo"],
                ["value" => "Atlantic/Cape_Verde","label" => "(GMT-01:00) Atlantic/Cape_Verde"],
                ["value" => "Atlantic/Azores","label" => "(GMT-01:00) Atlantic/Azores"],
                ["value" => "America/Scoresbysund","label" => "(GMT-01:00) America/Scoresbysund"],
                ["value" => "Europe/Lisbon","label" => "(GMT+00:00) Europe/Lisbon"],
                ["value" => "Europe/London","label" => "(GMT+00:00) Europe/London"],
                ["value" => "Europe/Jersey","label" => "(GMT+00:00) Europe/Jersey"],
                ["value" => "Europe/Isle_of_Man","label" => "(GMT+00:00) Europe/Isle_of_Man"],
                ["value" => "Atlantic/Faroe","label" => "(GMT+00:00) Atlantic/Faroe"],
                ["value" => "Europe/Guernsey","label" => "(GMT+00:00) Europe/Guernsey"],
                ["value" => "Europe/Dublin","label" => "(GMT+00:00) Europe/Dublin"],
                ["value" => "Atlantic/St_Helena","label" => "(GMT+00:00) Atlantic/St_Helena"],
                ["value" => "Atlantic/Reykjavik","label" => "(GMT+00:00) Atlantic/Reykjavik"],
                ["value" => "Atlantic/Madeira","label" => "(GMT+00:00) Atlantic/Madeira"],
                ["value" => "Atlantic/Canary","label" => "(GMT+00:00) Atlantic/Canary"],
                ["value" => "Africa/Accra","label" => "(GMT+00:00) Africa/Accra"],
                ["value" => "Antarctica/Troll","label" => "(GMT+00:00) Antarctica/Troll"],
                ["value" => "Africa/Abidjan","label" => "(GMT+00:00) Africa/Abidjan"],
                ["value" => "UTC","label" => "(GMT+00:00) UTC"],
                ["value" => "America/Danmarkshavn","label" => "(GMT+00:00) America/Danmarkshavn"],
                ["value" => "Africa/Monrovia","label" => "(GMT+00:00) Africa/Monrovia"],
                ["value" => "Africa/Dakar","label" => "(GMT+00:00) Africa/Dakar"],
                ["value" => "Africa/Conakry","label" => "(GMT+00:00) Africa/Conakry"],
                ["value" => "Africa/Casablanca","label" => "(GMT+00:00) Africa/Casablanca"],
                ["value" => "Africa/Lome","label" => "(GMT+00:00) Africa/Lome"],
                ["value" => "Africa/Freetown","label" => "(GMT+00:00) Africa/Freetown"],
                ["value" => "Africa/El_Aaiun","label" => "(GMT+00:00) Africa/El_Aaiun"],
                ["value" => "Africa/Bissau","label" => "(GMT+00:00) Africa/Bissau"],
                ["value" => "Africa/Nouakchott","label" => "(GMT+00:00) Africa/Nouakchott"],
                ["value" => "Africa/Banjul","label" => "(GMT+00:00) Africa/Banjul"],
                ["value" => "Africa/Ouagadougou","label" => "(GMT+00:00) Africa/Ouagadougou"],
                ["value" => "Africa/Bamako","label" => "(GMT+00:00) Africa/Bamako"],
                ["value" => "Europe/Gibraltar","label" => "(GMT+01:00) Europe/Gibraltar"],
                ["value" => "Africa/Bangui","label" => "(GMT+01:00) Africa/Bangui"],
                ["value" => "Europe/Ljubljana","label" => "(GMT+01:00) Europe/Ljubljana"],
                ["value" => "Africa/Ceuta","label" => "(GMT+01:00) Africa/Ceuta"],
                ["value" => "Africa/Algiers","label" => "(GMT+01:00) Africa/Algiers"],
                ["value" => "Europe/Busingen","label" => "(GMT+01:00) Europe/Busingen"],
                ["value" => "Europe/Copenhagen","label" => "(GMT+01:00) Europe/Copenhagen"],
                ["value" => "Europe/Madrid","label" => "(GMT+01:00) Europe/Madrid"],
                ["value" => "Europe/Budapest","label" => "(GMT+01:00) Europe/Budapest"],
                ["value" => "Europe/Brussels","label" => "(GMT+01:00) Europe/Brussels"],
                ["value" => "Europe/Bratislava","label" => "(GMT+01:00) Europe/Bratislava"],
                ["value" => "Europe/Berlin","label" => "(GMT+01:00) Europe/Berlin"],
                ["value" => "Europe/Belgrade","label" => "(GMT+01:00) Europe/Belgrade"],
                ["value" => "Europe/Andorra","label" => "(GMT+01:00) Europe/Andorra"],
                ["value" => "Europe/Amsterdam","label" => "(GMT+01:00) Europe/Amsterdam"],
                ["value" => "Europe/Luxembourg","label" => "(GMT+01:00) Europe/Luxembourg"],
                ["value" => "Europe/Monaco","label" => "(GMT+01:00) Europe/Monaco"],
                ["value" => "Europe/Malta","label" => "(GMT+01:00) Europe/Malta"],
                ["value" => "Europe/Tirane","label" => "(GMT+01:00) Europe/Tirane"],
                ["value" => "Europe/Zurich","label" => "(GMT+01:00) Europe/Zurich"],
                ["value" => "Europe/Zagreb","label" => "(GMT+01:00) Europe/Zagreb"],
                ["value" => "Europe/Warsaw","label" => "(GMT+01:00) Europe/Warsaw"],
                ["value" => "Europe/Vienna","label" => "(GMT+01:00) Europe/Vienna"],
                ["value" => "Europe/Vatican","label" => "(GMT+01:00) Europe/Vatican"],
                ["value" => "Europe/Vaduz","label" => "(GMT+01:00) Europe/Vaduz"],
                ["value" => "Europe/Stockholm","label" => "(GMT+01:00) Europe/Stockholm"],
                ["value" => "Africa/Brazzaville","label" => "(GMT+01:00) Africa/Brazzaville"],
                ["value" => "Europe/Skopje","label" => "(GMT+01:00) Europe/Skopje"],
                ["value" => "Europe/Sarajevo","label" => "(GMT+01:00) Europe/Sarajevo"],
                ["value" => "Europe/San_Marino","label" => "(GMT+01:00) Europe/San_Marino"],
                ["value" => "Europe/Rome","label" => "(GMT+01:00) Europe/Rome"],
                ["value" => "Europe/Prague","label" => "(GMT+01:00) Europe/Prague"],
                ["value" => "Europe/Paris","label" => "(GMT+01:00) Europe/Paris"],
                ["value" => "Europe/Oslo","label" => "(GMT+01:00) Europe/Oslo"],
                ["value" => "Europe/Podgorica","label" => "(GMT+01:00) Europe/Podgorica"],
                ["value" => "Africa/Douala","label" => "(GMT+01:00) Africa/Douala"],
                ["value" => "Arctic/Longyearbyen","label" => "(GMT+01:00) Arctic/Longyearbyen"],
                ["value" => "Africa/Malabo","label" => "(GMT+01:00) Africa/Malabo"],
                ["value" => "Africa/Kinshasa","label" => "(GMT+01:00) Africa/Kinshasa"],
                ["value" => "Africa/Libreville","label" => "(GMT+01:00) Africa/Libreville"],
                ["value" => "Africa/Ndjamena","label" => "(GMT+01:00) Africa/Ndjamena"],
                ["value" => "Africa/Lagos","label" => "(GMT+01:00) Africa/Lagos"],
                ["value" => "Africa/Niamey","label" => "(GMT+01:00) Africa/Niamey"],
                ["value" => "Africa/Porto-Novo","label" => "(GMT+01:00) Africa/Porto-Novo"],
                ["value" => "Africa/Sao_Tome","label" => "(GMT+01:00) Africa/Sao_Tome"],
                ["value" => "Africa/Luanda","label" => "(GMT+01:00) Africa/Luanda"],
                ["value" => "Africa/Tunis","label" => "(GMT+01:00) Africa/Tunis"],
                ["value" => "Europe/Uzhgorod","label" => "(GMT+02:00) Europe/Uzhgorod"],
                ["value" => "Africa/Harare","label" => "(GMT+02:00) Africa/Harare"],
                ["value" => "Europe/Mariehamn","label" => "(GMT+02:00) Europe/Mariehamn"],
                ["value" => "Africa/Lubumbashi","label" => "(GMT+02:00) Africa/Lubumbashi"],
                ["value" => "Asia/Nicosia","label" => "(GMT+02:00) Asia/Nicosia"],
                ["value" => "Africa/Windhoek","label" => "(GMT+02:00) Africa/Windhoek"],
                ["value" => "Europe/Tallinn","label" => "(GMT+02:00) Europe/Tallinn"],
                ["value" => "Europe/Zaporozhye","label" => "(GMT+02:00) Europe/Zaporozhye"],
                ["value" => "Africa/Gaborone","label" => "(GMT+02:00) Africa/Gaborone"],
                ["value" => "Africa/Mbabane","label" => "(GMT+02:00) Africa/Mbabane"],
                ["value" => "Africa/Khartoum","label" => "(GMT+02:00) Africa/Khartoum"],
                ["value" => "Africa/Johannesburg","label" => "(GMT+02:00) Africa/Johannesburg"],
                ["value" => "Europe/Vilnius","label" => "(GMT+02:00) Europe/Vilnius"],
                ["value" => "Africa/Maseru","label" => "(GMT+02:00) Africa/Maseru"],
                ["value" => "Africa/Lusaka","label" => "(GMT+02:00) Africa/Lusaka"],
                ["value" => "Europe/Riga","label" => "(GMT+02:00) Europe/Riga"],
                ["value" => "Africa/Kigali","label" => "(GMT+02:00) Africa/Kigali"],
                ["value" => "Europe/Helsinki","label" => "(GMT+02:00) Europe/Helsinki"],
                ["value" => "Africa/Maputo","label" => "(GMT+02:00) Africa/Maputo"],
                ["value" => "Europe/Chisinau","label" => "(GMT+02:00) Europe/Chisinau"],
                ["value" => "Europe/Sofia","label" => "(GMT+02:00) Europe/Sofia"],
                ["value" => "Asia/Beirut","label" => "(GMT+02:00) Asia/Beirut"],
                ["value" => "Africa/Blantyre","label" => "(GMT+02:00) Africa/Blantyre"],
                ["value" => "Asia/Jerusalem","label" => "(GMT+02:00) Asia/Jerusalem"],
                ["value" => "Asia/Gaza","label" => "(GMT+02:00) Asia/Gaza"],
                ["value" => "Asia/Amman","label" => "(GMT+02:00) Asia/Amman"],
                ["value" => "Asia/Famagusta","label" => "(GMT+02:00) Asia/Famagusta"],
                ["value" => "Europe/Athens","label" => "(GMT+02:00) Europe/Athens"],
                ["value" => "Africa/Bujumbura","label" => "(GMT+02:00) Africa/Bujumbura"],
                ["value" => "Asia/Hebron","label" => "(GMT+02:00) Asia/Hebron"],
                ["value" => "Europe/Kaliningrad","label" => "(GMT+02:00) Europe/Kaliningrad"],
                ["value" => "Africa/Cairo","label" => "(GMT+02:00) Africa/Cairo"],
                ["value" => "Europe/Kiev","label" => "(GMT+02:00) Europe/Kiev"],
                ["value" => "Europe/Bucharest","label" => "(GMT+02:00) Europe/Bucharest"],
                ["value" => "Asia/Damascus","label" => "(GMT+02:00) Asia/Damascus"],
                ["value" => "Africa/Tripoli","label" => "(GMT+02:00) Africa/Tripoli"],
                ["value" => "Asia/Baghdad","label" => "(GMT+03:00) Asia/Baghdad"],
                ["value" => "Africa/Djibouti","label" => "(GMT+03:00) Africa/Djibouti"],
                ["value" => "Asia/Aden","label" => "(GMT+03:00) Asia/Aden"],
                ["value" => "Asia/Bahrain","label" => "(GMT+03:00) Asia/Bahrain"],
                ["value" => "Europe/Istanbul","label" => "(GMT+03:00) Europe/Istanbul"],
                ["value" => "Africa/Juba","label" => "(GMT+03:00) Africa/Juba"],
                ["value" => "Europe/Kirov","label" => "(GMT+03:00) Europe/Kirov"],
                ["value" => "Europe/Moscow","label" => "(GMT+03:00) Europe/Moscow"],
                ["value" => "Antarctica/Syowa","label" => "(GMT+03:00) Antarctica/Syowa"],
                ["value" => "Europe/Minsk","label" => "(GMT+03:00) Europe/Minsk"],
                ["value" => "Africa/Kampala","label" => "(GMT+03:00) Africa/Kampala"],
                ["value" => "Africa/Dar_es_Salaam","label" => "(GMT+03:00) Africa/Dar_es_Salaam"],
                ["value" => "Europe/Simferopol","label" => "(GMT+03:00) Europe/Simferopol"],
                ["value" => "Asia/Riyadh","label" => "(GMT+03:00) Asia/Riyadh"],
                ["value" => "Indian/Antananarivo","label" => "(GMT+03:00) Indian/Antananarivo"],
                ["value" => "Asia/Kuwait","label" => "(GMT+03:00) Asia/Kuwait"],
                ["value" => "Africa/Nairobi","label" => "(GMT+03:00) Africa/Nairobi"],
                ["value" => "Indian/Mayotte","label" => "(GMT+03:00) Indian/Mayotte"],
                ["value" => "Africa/Mogadishu","label" => "(GMT+03:00) Africa/Mogadishu"],
                ["value" => "Asia/Qatar","label" => "(GMT+03:00) Asia/Qatar"],
                ["value" => "Europe/Volgograd","label" => "(GMT+03:00) Europe/Volgograd"],
                ["value" => "Africa/Asmara","label" => "(GMT+03:00) Africa/Asmara"],
                ["value" => "Africa/Addis_Ababa","label" => "(GMT+03:00) Africa/Addis_Ababa"],
                ["value" => "Indian/Comoro","label" => "(GMT+03:00) Indian/Comoro"],
                ["value" => "Asia/Tehran","label" => "(GMT+03:30) Asia/Tehran"],
                ["value" => "Europe/Saratov","label" => "(GMT+04:00) Europe/Saratov"],
                ["value" => "Indian/Reunion","label" => "(GMT+04:00) Indian/Reunion"],
                ["value" => "Europe/Astrakhan","label" => "(GMT+04:00) Europe/Astrakhan"],
                ["value" => "Asia/Baku","label" => "(GMT+04:00) Asia/Baku"],
                ["value" => "Asia/Dubai","label" => "(GMT+04:00) Asia/Dubai"],
                ["value" => "Indian/Mauritius","label" => "(GMT+04:00) Indian/Mauritius"],
                ["value" => "Indian/Mahe","label" => "(GMT+04:00) Indian/Mahe"],
                ["value" => "Asia/Tbilisi","label" => "(GMT+04:00) Asia/Tbilisi"],
                ["value" => "Asia/Yerevan","label" => "(GMT+04:00) Asia/Yerevan"],
                ["value" => "Asia/Muscat","label" => "(GMT+04:00) Asia/Muscat"],
                ["value" => "Europe/Samara","label" => "(GMT+04:00) Europe/Samara"],
                ["value" => "Europe/Ulyanovsk","label" => "(GMT+04:00) Europe/Ulyanovsk"],
                ["value" => "Asia/Kabul","label" => "(GMT+04:30) Asia/Kabul"],
                ["value" => "Antarctica/Mawson","label" => "(GMT+05:00) Antarctica/Mawson"],
                ["value" => "Asia/Samarkand","label" => "(GMT+05:00) Asia/Samarkand"],
                ["value" => "Asia/Aqtobe","label" => "(GMT+05:00) Asia/Aqtobe"],
                ["value" => "Indian/Maldives","label" => "(GMT+05:00) Indian/Maldives"],
                ["value" => "Asia/Ashgabat","label" => "(GMT+05:00) Asia/Ashgabat"],
                ["value" => "Asia/Atyrau","label" => "(GMT+05:00) Asia/Atyrau"],
                ["value" => "Asia/Dushanbe","label" => "(GMT+05:00) Asia/Dushanbe"],
                ["value" => "Asia/Yekaterinburg","label" => "(GMT+05:00) Asia/Yekaterinburg"],
                ["value" => "Asia/Oral","label" => "(GMT+05:00) Asia/Oral"],
                ["value" => "Asia/Aqtau","label" => "(GMT+05:00) Asia/Aqtau"],
                ["value" => "Asia/Karachi","label" => "(GMT+05:00) Asia/Karachi"],
                ["value" => "Asia/Tashkent","label" => "(GMT+05:00) Asia/Tashkent"],
                ["value" => "Indian/Kerguelen","label" => "(GMT+05:00) Indian/Kerguelen"],
                ["value" => "Asia/Colombo","label" => "(GMT+05:30) Asia/Colombo"],
                ["value" => "Asia/Kolkata","label" => "(GMT+05:30) Asia/Kolkata"],
                ["value" => "Asia/Kathmandu","label" => "(GMT+05:45) Asia/Kathmandu"],
                ["value" => "Antarctica/Vostok","label" => "(GMT+06:00) Antarctica/Vostok"],
                ["value" => "Indian/Chagos","label" => "(GMT+06:00) Indian/Chagos"],
                ["value" => "Asia/Almaty","label" => "(GMT+06:00) Asia/Almaty"],
                ["value" => "Asia/Omsk","label" => "(GMT+06:00) Asia/Omsk"],
                ["value" => "Asia/Dhaka","label" => "(GMT+06:00) Asia/Dhaka"],
                ["value" => "Asia/Bishkek","label" => "(GMT+06:00) Asia/Bishkek"],
                ["value" => "Asia/Urumqi","label" => "(GMT+06:00) Asia/Urumqi"],
                ["value" => "Asia/Thimphu","label" => "(GMT+06:00) Asia/Thimphu"],
                ["value" => "Asia/Qyzylorda","label" => "(GMT+06:00) Asia/Qyzylorda"],
                ["value" => "Indian/Cocos","label" => "(GMT+06:30) Indian/Cocos"],
                ["value" => "Asia/Yangon","label" => "(GMT+06:30) Asia/Yangon"],
                ["value" => "Asia/Novokuznetsk","label" => "(GMT+07:00) Asia/Novokuznetsk"],
                ["value" => "Asia/Barnaul","label" => "(GMT+07:00) Asia/Barnaul"],
                ["value" => "Antarctica/Davis","label" => "(GMT+07:00) Antarctica/Davis"],
                ["value" => "Asia/Novosibirsk","label" => "(GMT+07:00) Asia/Novosibirsk"],
                ["value" => "Asia/Krasnoyarsk","label" => "(GMT+07:00) Asia/Krasnoyarsk"],
                ["value" => "Asia/Phnom_Penh","label" => "(GMT+07:00) Asia/Phnom_Penh"],
                ["value" => "Asia/Pontianak","label" => "(GMT+07:00) Asia/Pontianak"],
                ["value" => "Asia/Jakarta","label" => "(GMT+07:00) Asia/Jakarta"],
                ["value" => "Asia/Hovd","label" => "(GMT+07:00) Asia/Hovd"],
                ["value" => "Asia/Tomsk","label" => "(GMT+07:00) Asia/Tomsk"],
                ["value" => "Asia/Ho_Chi_Minh","label" => "(GMT+07:00) Asia/Ho_Chi_Minh"],
                ["value" => "Asia/Vientiane","label" => "(GMT+07:00) Asia/Vientiane"],
                ["value" => "Indian/Christmas","label" => "(GMT+07:00) Indian/Christmas"],
                ["value" => "Asia/Bangkok","label" => "(GMT+07:00) Asia/Bangkok"],
                ["value" => "Asia/Choibalsan","label" => "(GMT+08:00) Asia/Choibalsan"],
                ["value" => "Asia/Taipei","label" => "(GMT+08:00) Asia/Taipei"],
                ["value" => "Asia/Makassar","label" => "(GMT+08:00) Asia/Makassar"],
                ["value" => "Asia/Macau","label" => "(GMT+08:00) Asia/Macau"],
                ["value" => "Asia/Kuching","label" => "(GMT+08:00) Asia/Kuching"],
                ["value" => "Asia/Kuala_Lumpur","label" => "(GMT+08:00) Asia/Kuala_Lumpur"],
                ["value" => "Asia/Shanghai","label" => "(GMT+08:00) Asia/Shanghai"],
                ["value" => "Asia/Singapore","label" => "(GMT+08:00) Asia/Singapore"],
                ["value" => "Asia/Brunei","label" => "(GMT+08:00) Asia/Brunei"],
                ["value" => "Asia/Irkutsk","label" => "(GMT+08:00) Asia/Irkutsk"],
                ["value" => "Asia/Ulaanbaatar","label" => "(GMT+08:00) Asia/Ulaanbaatar"],
                ["value" => "Australia/Perth","label" => "(GMT+08:00) Australia/Perth"],
                ["value" => "Asia/Hong_Kong","label" => "(GMT+08:00) Asia/Hong_Kong"],
                ["value" => "Antarctica/Casey","label" => "(GMT+08:00) Antarctica/Casey"],
                ["value" => "Asia/Manila","label" => "(GMT+08:00) Asia/Manila"],
                ["value" => "Australia/Eucla","label" => "(GMT+08:45) Australia/Eucla"],
                ["value" => "Asia/Jayapura","label" => "(GMT+09:00) Asia/Jayapura"],
                ["value" => "Asia/Khandyga","label" => "(GMT+09:00) Asia/Khandyga"],
                ["value" => "Pacific/Palau","label" => "(GMT+09:00) Pacific/Palau"],
                ["value" => "Asia/Dili","label" => "(GMT+09:00) Asia/Dili"],
                ["value" => "Asia/Yakutsk","label" => "(GMT+09:00) Asia/Yakutsk"],
                ["value" => "Asia/Tokyo","label" => "(GMT+09:00) Asia/Tokyo"],
                ["value" => "Asia/Seoul","label" => "(GMT+09:00) Asia/Seoul"],
                ["value" => "Asia/Chita","label" => "(GMT+09:00) Asia/Chita"],
                ["value" => "Asia/Pyongyang","label" => "(GMT+09:00) Asia/Pyongyang"],
                ["value" => "Australia/Darwin","label" => "(GMT+09:30) Australia/Darwin"],
                ["value" => "Asia/Ust-Nera","label" => "(GMT+10:00) Asia/Ust-Nera"],
                ["value" => "Pacific/Chuuk","label" => "(GMT+10:00) Pacific/Chuuk"],
                ["value" => "Antarctica/DumontDUrville","label" => "(GMT+10:00) Antarctica/DumontDUrville"],
                ["value" => "Pacific/Guam","label" => "(GMT+10:00) Pacific/Guam"],
                ["value" => "Pacific/Port_Moresby","label" => "(GMT+10:00) Pacific/Port_Moresby"],
                ["value" => "Asia/Vladivostok","label" => "(GMT+10:00) Asia/Vladivostok"],
                ["value" => "Australia/Brisbane","label" => "(GMT+10:00) Australia/Brisbane"],
                ["value" => "Australia/Lindeman","label" => "(GMT+10:00) Australia/Lindeman"],
                ["value" => "Pacific/Saipan","label" => "(GMT+10:00) Pacific/Saipan"],
                ["value" => "Australia/Adelaide","label" => "(GMT+10:30) Australia/Adelaide"],
                ["value" => "Australia/Broken_Hill","label" => "(GMT+10:30) Australia/Broken_Hill"],
                ["value" => "Australia/Sydney","label" => "(GMT+11:00) Australia/Sydney"],
                ["value" => "Antarctica/Macquarie","label" => "(GMT+11:00) Antarctica/Macquarie"],
                ["value" => "Pacific/Noumea","label" => "(GMT+11:00) Pacific/Noumea"],
                ["value" => "Pacific/Norfolk","label" => "(GMT+11:00) Pacific/Norfolk"],
                ["value" => "Australia/Melbourne","label" => "(GMT+11:00) Australia/Melbourne"],
                ["value" => "Pacific/Kosrae","label" => "(GMT+11:00) Pacific/Kosrae"],
                ["value" => "Pacific/Pohnpei","label" => "(GMT+11:00) Pacific/Pohnpei"],
                ["value" => "Australia/Currie","label" => "(GMT+11:00) Australia/Currie"],
                ["value" => "Pacific/Guadalcanal","label" => "(GMT+11:00) Pacific/Guadalcanal"],
                ["value" => "Pacific/Efate","label" => "(GMT+11:00) Pacific/Efate"],
                ["value" => "Australia/Hobart","label" => "(GMT+11:00) Australia/Hobart"],
                ["value" => "Asia/Magadan","label" => "(GMT+11:00) Asia/Magadan"],
                ["value" => "Asia/Sakhalin","label" => "(GMT+11:00) Asia/Sakhalin"],
                ["value" => "Pacific/Bougainville","label" => "(GMT+11:00) Pacific/Bougainville"],
                ["value" => "Australia/Lord_Howe","label" => "(GMT+11:00) Australia/Lord_Howe"],
                ["value" => "Asia/Srednekolymsk","label" => "(GMT+11:00) Asia/Srednekolymsk"],
                ["value" => "Pacific/Fiji","label" => "(GMT+12:00) Pacific/Fiji"],
                ["value" => "Pacific/Wake","label" => "(GMT+12:00) Pacific/Wake"],
                ["value" => "Pacific/Nauru","label" => "(GMT+12:00) Pacific/Nauru"],
                ["value" => "Pacific/Majuro","label" => "(GMT+12:00) Pacific/Majuro"],
                ["value" => "Asia/Kamchatka","label" => "(GMT+12:00) Asia/Kamchatka"],
                ["value" => "Pacific/Kwajalein","label" => "(GMT+12:00) Pacific/Kwajalein"],
                ["value" => "Pacific/Funafuti","label" => "(GMT+12:00) Pacific/Funafuti"],
                ["value" => "Pacific/Wallis","label" => "(GMT+12:00) Pacific/Wallis"],
                ["value" => "Asia/Anadyr","label" => "(GMT+12:00) Asia/Anadyr"],
                ["value" => "Pacific/Tarawa","label" => "(GMT+12:00) Pacific/Tarawa"],
                ["value" => "Pacific/Fakaofo","label" => "(GMT+13:00) Pacific/Fakaofo"],
                ["value" => "Pacific/Enderbury","label" => "(GMT+13:00) Pacific/Enderbury"],
                ["value" => "Pacific/Auckland","label" => "(GMT+13:00) Pacific/Auckland"],
                ["value" => "Antarctica/McMurdo","label" => "(GMT+13:00) Antarctica/McMurdo"],
                ["value" => "Pacific/Tongatapu","label" => "(GMT+13:00) Pacific/Tongatapu"],
                ["value" => "Pacific/Chatham","label" => "(GMT+13:45) Pacific/Chatham"],
                ["value" => "Pacific/Kiritimati","label" => "(GMT+14:00) Pacific/Kiritimati"],
                ["value" => "Pacific/Apia","label" => "(GMT+14:00) Pacific/Apia"],
                
                
                
            ]
        ]);
           $setting -> component = "select";
          $setting->save();
          $attr = json_decode($setting->attr);
          $timezone_date = auth('api')->user()->timezone." ".Timezone::convertToLocal( now());
          return response()->json(['attr'=> $attr, 'timezone' => auth('api')->user()->timezone,'date'=>$timezone_date]);
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $timezone = $request->timezone;
         $user =  User::find(auth('api')->user()->id);
        $user -> timezone = $timezone;
        $user->save();
        
       $date = $timezone." ". Timezone::convertToLocal(now(),null,$timezone);
       
       return response()->json(['timezone'=> $timezone,'date'=>$date]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getTimeZone()
    {
        $timezone = auth('api')->user()->timezone;
        return response()->json(['timezone'=>$timezone,'date'=> $time_zone." ".Timezone::convertToLocal( now())]);
    }
}
