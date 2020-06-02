<?php 

/**
 * Klasse EventController 
 *
 * Führt Operationen mit Event-Objekten aus, stellt Events in Auflistungen dar 
 *
 * @param   array $events - Array für Event-Objekte 
 * @author  Philipp Wiens 
 */

class EventController {

  private $events = array(); 

  /**
   * Wandelt ein Datenbank-Objekt (item) in ein Event-Objekt (object) um 
   *
   * @param   $eventid
   * @param   $category
   * @param   $date 
   * @param   $start 
   * @param   $end 
   * @param   $city 
   * @param   $location 
   * @param   $title 
   * @param   $titleTeaser 
   * @param   $text1 
   * @param   $text2 
   * @param   $fee 
   * @return  Object $eventObject - Event-Objekt
   * @author  Philipp Wiens 
   */     
   public function itemToObject($row){
    
    $datvon = strtotime($row['datvon']);
    $date = date("d.m.Y", $datvon);
    
    $start = date("H:i", $datvon);
    
    $datbis = strtotime($row['datbis']);
    $end = date("H:i", $datbis);

    $eventObject = new Event($row['seminarid'], $row['seminarart'], $date, $start, $end, $row['ort'], $row['location'], $row['titel'], $row['titelheadline'], $row['memo3'], $row['memo4'], $row['preis']); 
    return $eventObject; 
  }

  /**
   * Ruft einen Datensatz ab und speichert diesen als Event-Objekt 
   *
   * @param   Object $result - Datenobjekt der DB-Abfrage
   * @return  Object $event - Event-Objekt
   * @author  Philipp Wiens 
   */     
  public function saveItemAsObject($result){

    $row = $result->fetch_assoc();

    $event = $this->itemToObject($row); 
    return $event; 
  } 

  /**
   * Speichert Event-Objekte im Array für Events 
   *
   * @param   Object $result - Datensatz der DB-Abfrage
   * @return  Array $events - Array mit Event-Objekten 
   * @author  Philipp Wiens 
   */   
  public function saveItemsInArray($result) {

    $i = 1; 
    while($row = $result->fetch_assoc()) {

        $datvon = strtotime($row['datvon']);
        $date = date("d.m.Y", $datvon);
        
        $start = date("H:i", $datvon);
        
        $datbis = strtotime($row['datbis']);
        $end = date("H:i", $datbis);
        


        ${"event" . $i} = $this->itemToObject($row); 

        $events[] = ${"event" . $i}; 
        $i++; 
    }

    return $events; 

  }

  /**
   * Stellt einen Seitenblock für zukünftige oder vergangene Veranstaltungen dar 
   *
   * @param   Array $events - Array mit allen darzustellenden Events 
   * @param   boolean $future - Legt fest, ob das Event in der Zukunft oder in der Vergangenheit liegt 
   * @author  Philipp Wiens 
   */   
   public function displayItemSection($events, $future){
    $eventNumber = count($events); 

    if($future == true) {
      $itemNumber = 0; 

      echo '<div class="row">';
        echo '<div class="col-12 ibo-events-title ibo-recent-events-title">';
          echo 'Aktuelle Events';
        echo '</div>';
      echo '</div>';
      echo '<div class="row">';
        echo '<div class="col-12 px-4 py-3 ibo-recent-events-wrapper">';

      while($itemNumber < $eventNumber){
          
          $this->displayFutureItem($events, $itemNumber); 
          $itemNumber++; 
      }

          echo '<hr class="ibo-events-separator-line">';
        echo '</div>';
      echo '</div>';

    } else {

      echo '<div class="row mt-5">';
        echo '<div class="col-12 ibo-events-title ibo-past-events-title">';
          echo 'Vergangene Events';
        echo '</div>';
      echo '</div>';

      echo '<div class="row mb-5">';
        echo '<div class="col-12 px-4 py-2 ibo-past-events-wrapper">';
          echo '<div class="row">';

      $itemNumber = 0; 
      while($itemNumber < $eventNumber){
          
          $this->displayPastItem($events, $itemNumber); 
          $itemNumber++; 
      }

          echo '</div>';
        echo '</div>';
      echo '</div>';

    }
  }

  /**
   * Stellt einen Eintrag mit einer Veranstaltung in der Zukunft dar 
   *
   * @param   Array $events - Array mit allen darzustellenden Events 
   * @param   int $itemNumber - Nummer des darzustellenden Events 
   * @author  Philipp Wiens 
   */   
  public function displayFutureItem($events, $itemNumber){
        $eventid = $events[$itemNumber]->eventid;
        $category = $events[$itemNumber]->category; 
        $date = $events[$itemNumber]->date; 
        $dateFormatted = date("d.m.Y", strtotime($date));
        $city = $events[$itemNumber]->city; 
        $titleTeaser = $events[$itemNumber]->titleTeaser; 
        $title = $events[$itemNumber]->title; 
        $text1 = $events[$itemNumber]->text1; 

        $imageData = $this->getImageForItem($itemNumber); 
        $image = $imageData[0]; 
        $imageAltText = $imageData[1];

        $hideEleOnMobile; 
        $marginForEleOnMobile; 

        if (($itemNumber == 1) || ($itemNumber == 4)) {
            $hideEleOnMobile = ''; 
            $marginForLeftEleOnMobile = 'mb-3 mb-md-0'; 
            $marginForRightEleOnMobile = 'mt-3 mt-md-0'; 
        } else {
            $hideEleOnMobile = 'd-none d-md-block'; 
            $marginForLeftEleOnMobile = ''; 
            $marginForRightEleOnMobile = ''; 
        }

        echo '<div class="card ibo-events-card">';
        echo '<div class="row no-gutters">'; 

        if($itemNumber < 3) {
            echo '<div class="col-md-5 pr-md-3 ' . $hideEleOnMobile . $marginForLeftEleOnMobile . '">'; 
            echo '<img src="img/' . $image . '" class="card-img ibo-events-card-img" alt="' . $imageAltText . '">';
            echo '</div>'; 
        }
 
        echo '<div class="col-md-7">'; 
        echo '<a class="ibo-card-link" href="overview.php?eventid='. $eventid .'&title='. $title .'">'; 
        echo '<div class="card-body ibo-events-card-body ">'; 
        echo '<h6>'. $category .' | am ' . $dateFormatted . ' | in ' . $city . '</h6>'; 
        echo '<h1>' . $titleTeaser . '</h1>'; 
        echo '<p>' . $text1 . '</p>'; 
        echo '</div>'; 
        echo '</a>'; 
        echo '</div>';

        if($itemNumber > 2) {
            echo '<div class="col-md-5 pl-md-3 ' . $hideEleOnMobile . $marginForRightEleOnMobile . '">';
            echo '<img src="img/' . $image . '" class="card-img ibo-events-card-img" alt="' . $imageAltText . '">';
            echo '</div>';
        }

        echo '</div>';
        echo '</div>';
  }

  /**
   * Stellt einen Eintrag mit einer Veranstaltung in der Vergangenheit dar 
   *
   * @param   Array $events - Array mit allen darzustellenden Events 
   * @param   int $itemNumber - Nummer des darzustellenden Events 
   * @author  Philipp Wiens 
   */   
   public function displayPastItem($events, $itemNumber){
    $eventid = $events[$itemNumber]->eventid;
    $category = $events[$itemNumber]->category; 
    $date = $events[$itemNumber]->date; 
    $dateFormatted = date("d.m.Y", strtotime($date));
    $city = $events[$itemNumber]->city; 
    $title = $events[$itemNumber]->title; 
    $titleTeaser = $events[$itemNumber]->titleTeaser; 
    $text1 = $events[$itemNumber]->text1; 

    echo '<div class="col-12 col-md-6">';
    echo '<div class="card ibo-events-card ibo-past-events-card my-2">';
    echo '<div class="row no-gutters">';
    echo '<a class="ibo-card-link ibo-past-card-link" href="overview.php?eventid='. $eventid .'&title='. $title .'">';
    echo '<div class="card-body ibo-events-card-body ibo-past-events-card-body">';
    echo '<h6>'. $category .' | '. $dateFormatted .' | '. $city .'</h6>';
    echo '<h1>'. $titleTeaser .'</h1>';
    echo '<p>'. $text1 .'</p>';
    echo '</div>';
    echo '</a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

  /**
   * Liefert ein Bild für einen Event-Listeneintrag von 'img/eventImages.xml' 
   *
   * @param   int $itemNumber - Nummer des 'item'
   * @return  Array $imageData - Array mit Dateiname und Alt-Text des Bildes 
   * @author  Philipp Wiens 
   */   
   public function getImageForItem($itemNumber){

    $imageData = array(); 

    $xmlFile = simplexml_load_file("img/eventImages.xml") or die("Bilder konnten nicht geladen werden.");
    $xmlFileSize = count($xmlFile);

    // Falls die Bildliste im XML-File kürzer ist als die Einträge:
    if(($itemNumber+1) > $xmlFileSize){
      while(($itemNumber+1) > $xmlFileSize) {
        $itemNumber = $itemNumber - $xmlFileSize; 
        echo 'itemNumber: ' . $itemNumber; 
      }
    }
    
    $filename = $xmlFile->image[$itemNumber]->filename; 
    $alttext = $xmlFile->image[$itemNumber]->alttext; 

    $imageData[] = $filename; 
    $imageData[] = $alttext; 

    return $imageData; 
  }

  /**
   * Stellt eine Info-Box auf der Veranstaltungs-Detailseite dar
   *
   * @param  Event $currentEvent - Objekt des aktuellen Events 
   * @author  Philipp Wiens 
   */   
  public function displayInfoSection($currentEvent){

    $location = $currentEvent->location; 
    $date = $currentEvent->date; 
    $timestamp = strtotime($date); 
    $dateGerman = strftime("%A, der %d. %B %Y", $timestamp); 
    $start = $currentEvent->start; 
    $end = $currentEvent->end; 
    if(isset($currentEvent->fee) && $currentEvent->fee != 0 &&  $currentEvent->fee != '') {
      $fee = $currentEvent->fee; 
    } else {
      $fee = 'Die Veranstaltung ist kostenlos.'; 
    }

    echo '<div class="ibo-infobox my-3 mr-lg-4 p-3 px-md-4">'; 
    echo '<h3 class="ibo-red">Kurz-Info</h3>'; 
    echo '<div class="row">';
    echo '<div class="col-6 ibo-infobox-content">';
    echo '<p><strong>Ort</strong><br>'. $location .'</p>'; 
    echo '<p><strong>Zeit</strong><br>'. $dateGerman .', <span class="ibo-nobreak">'.$start.' – '.$end.' Uhr</span></p>';     
    echo '</div>';
    echo '<div class="col-6 ibo-infobox-content">';
    echo '<p><strong>Teilnahmegebühr</strong><br>'; 
    echo $fee; 
    echo '</p>'; 
    echo '</div>'; 
    echo '</div>'; 
    echo '</div>'; 

  }

  /**
   * Stellt eine Google-Maps-Karte auf der Veranstaltungs-Detailseite dar (PROVISORISCH)
   *
   * @author  Philipp Wiens 
   */   
  public function displayMap(){

        echo '<div class="jumbotron mb-2">';
          echo '<h3 class="ibo-red">Anfahrt</h3>';
          echo '<div class="ibo-map mt-2">';
            echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30772.117583472253!2d8.56683243987894!3d50.06165193839831!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47bd0b8491061b4d%3A0xb0b9b19e6e46c75d!2sHilton%20Frankfurt%20Airport!5e0!3m2!1sde!2sde!4v1585242779398!5m2!1sde!2sde" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>';
          echo '</div>';
        echo '</div>';

  }

  
}