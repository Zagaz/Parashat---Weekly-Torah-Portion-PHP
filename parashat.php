<?php
//Fetch data from API
function kaluach()
{

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://www.hebcal.com/hebcal?v=1&cfg=json&maj=on&min=on&mod=on&nx=on&year=now&month=x&ss=on&mf=on&c=on&geo=geoname&geonameid=3448439&m=50&s=on',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
  ));

  $response = curl_exec($curl);

  return json_decode($response, JSON_PRETTY_PRINT);
  curl_close($curl);
}

// Filter data from API

//php now
$now = new DateTime();
//timezone BST (Brazilian Standard Time)
//If you need to change it, please check the list here 
//https://www.php.net/manual/en/timezones.php.

$now->setTimezone(new DateTimeZone('America/Sao_Paulo'));
// date forma (Y-m-d)
$date = $now->format('Y-m-d');

// Store data in array
$arr = kaluach();

// Get raw data and store in array
for ($i = 0; $i < count($arr['items']); $i++) {
  //Vars
  $parashat_title;
  $parashat_date;
  $parashat_hebrew;
  $parashat_english;
  $parashat_torah;
  $previews_parashat;
  $next_parashat;
  //Get this week's parashat
  if ($arr['items'][$i]['category'] == "parashat") {
    //Data to be evaluated
    $parashat_end = $arr['items'][$i]['date'];
    $parashat_start = date('Y-m-d', strtotime($parashat_end . ' -6 days'));
    $parashat_title = $arr['items'][$i]['title'];

    //Filter week's parashat by Date
    if ($date >= $parashat_start && $date <= $parashat_end) {
      //Store data vars
      $parashat_title = $arr['items'][$i]['title'];
      $parashat_title = substr($parashat_title, strpos($parashat_title, ' ') + 1);
      $parashat_date = $arr['items'][$i]['date'];
      $parashat_hebrew = $arr['items'][$i]['hebrew'];
      $parashat_torah = $arr['items'][$i]['leyning']['torah'];
      $torah_trad = explode(" ", $parashat_torah);

      // array with variables above
      $parashat_array = array(
        'parashat_title' => $parashat_title,
        'parashat_date' => $parashat_date,
        'parashat_hebrew' => $parashat_hebrew,
        'parashat_torah' => "", // Next SWITCH
        'haftorah' => "", // See IF below SWITCH
      );

      // If you need to change the names of the Torah Books, just change the string name
      
      abstract class TorahBook
    {
        const Genesis = 'Bereshit/Genesis' ;
        const Exodus = 'Shemot/Exodus';
        const Leviticus = 'Vayikra/Leviticus';
        const Numbers = 'Bamidbar/Numbers';
        const Deuteronomy = 'Devarim/Deuteronomy';
    }

    //Torah Book names
      switch ($torah_trad[0]) {
        case 'Genesis':
          $parashat_torah = str_replace('Genesis', TorahBook::Genesis, $torah_trad[0]);
          $parashat_array['parashat_torah'] = $parashat_torah;

          break;
        case 'Exodus':
          $parashat_torah = str_replace('Exodus', TorahBook::Exodus, $torah_trad[0]);
          $parashat_array['parashat_torah'] = $parashat_torah;
          break;

        case 'Leviticus':
          $parashat_torah = str_replace('Leviticus', TorahBook::Leviticus, $torah_trad[0]);
          $parashat_array['parashat_torah'] = $parashat_torah;
          break;

        case 'Numbers':
          $parashat_torah = str_replace('Numbers', TorahBook::Numbers, $torah_trad[0]);
          $parashat_array['parashat_torah'] = $parashat_torah;
          break;

        case 'Deuteronomy':
          $parashat_torah = str_replace('Deuteronomy', TorahBook::Deuteronomy , $torah_trad[0]);
          $parashat_array['parashat_torah'] = $parashat_torah;
          break;

        default:

          break;
      }
      //Haftarah
      $haftorah = "";
      $haftorahAshk = "";
      $parashat_haftorah_seph = (isset($arr['items'][$i]['leyning']['haftarah_sephardic'])) ? $arr['items'][$i]['leyning']['haftarah_sephardic'] : "";
      $parashat_haftorah_ashk = $arr['items'][$i]['leyning']['haftarah'];

      if ($parashat_haftorah_seph != "") {
        $haftorah = "Haftarah: " . $parashat_haftorah_seph . "Ashkenazi: " . $parashat_haftorah_ashk;
        $parashat_array['haftorah'] = $haftorah;
      } else {
        $haftorah = $parashat_haftorah_ashk;
        $parashat_array['haftorah'] = $haftorah;
      }
    }
  }
}
?>
