<?php 

/**
 * Klasse AgendaController 
 *
 * Führt Operationen mit AgendaSlot-Objekten aus, stellt Programmpunkte in Agenda dar 
 *
 * @param   array $events - Array für AgendaSlot-Objekte 
 * @author  Philipp Wiens 
 */

class AgendaController {

  private $agenda = array(); 

  /**
   * Wandelt ein Datenbank-Objekt (item) in ein AgendaSlot-Objekt (object) um 
   *
   * @param   Object $row - DB-Abfrage-Objekt
   * @return  Object $agendaSlot - AgendaSlot-Objekt
   * @author  Philipp Wiens 
   */     
  public function itemToObject($row){
    
    $agendaSlot = new AgendaSlot($row['SlotId'], $row['SemId'], $row['Txt'], $row['RaumNr'], $row['DatVon'], $row['DatBis'], $row['DozId'], $row['Name'], $row['Foto'], $row['Unternehmen'], $row['Position'], $row['Besch']);

    return $agendaSlot; 
  }

  /**
   * Speichert AgendaSlot-Objekte im Agenda-Array
   *
   * @param   Object $result - Objekt  der DB-Abfrage
   * @return  Array $agenda - Array mit AgendaSlot-Objekten 
   * @author  Philipp Wiens 
   */   
  public function saveItemsInArray($result){

    $i = 1; 
    while($row = $result->fetch_assoc()) {
        
        ${"agendaSlot" . $i} = $this->itemToObject($row); 
        $agenda[] = ${"agendaSlot" . $i}; 
        $i++; 
    }
    return $agenda; 
  } 

  /**
   * Stellt einen den Seitenblock der Programmübersicht dar 
   *
   * @param   Array $agenda - Array mit allen darzustellenden AgendaSlots 
   * @author  Philipp Wiens 
   */   
  public function displayItemSection($agenda){
    $slotNumber = count($agenda); 
    $itemNumber = 0;

    if($slotNumber == 0) {
      echo '<div class="ibo-agenda-no-content m-5 p-md-5">Es sind noch keine Programminformationen hinterlegt.</div>';
      return; 
    }

    echo '<h3 class="ibo-red">Agenda</h3>'; 

    while($itemNumber < $slotNumber){
      
      if(($agenda[$itemNumber]->startTime == $agenda[$itemNumber+1]->startTime) && ($agenda[$itemNumber]->startTime == $agenda[$itemNumber+2]->startTime)){
          $this->displayAgendaStreamGroup($agenda, $itemNumber);
          $itemNumber = $itemNumber + 3;
        
          continue; 
      }
      
      $currentSlot = $agenda[$itemNumber]; 
      $this->displayAgendaItem($currentSlot, $itemNumber); 
      $itemNumber++; 
    }
  }

  /**
   * Stellt einen Eintrag mit einem Programmpunkt (AgendaSlot) dar 
   *
   * @param   Object $currentSlot - Objekt des darzustellenden AgendaSlots
   * @author  Philipp Wiens 
   */   
  public function displayAgendaItem($currentSlot, $itemNumber){
    $className = 'item' . $itemNumber; 
    
    $startTime = $currentSlot->startTime; 
    $startTimeFormatted = date("G:i", strtotime($startTime));
    $endTime = $currentSlot->endTime; 
    $endTimeFormatted = date("G:i", strtotime($endTime));

    $roomNum = $currentSlot->roomNum; 
    
    $timeSpan; 
    if(isset($endTime)){
      $timeSpan = $startTimeFormatted .' - '. $endTimeFormatted; 
    } else {
      $timeSpan = $startTimeFormatted; 
    }

    $text = $currentSlot->text; 
    $speakerName = $currentSlot->speakerName; 
    $roomNum = $currentSlot->roomNum; 
    $speakerImg = $currentSlot->speakerImg; 
    $speakerId = $currentSlot->speakerId; 
    
    if($roomNum == 0){
      echo '<div class="row mb-3">';
      echo '<div class="ibo-agenda-item col-12 col-md-10 offset-md-1">';
      echo '<div class="ibo-headline-bar row">';
      echo '<div class="ibo-time col-4">'. $timeSpan .'</div>';
      echo '<div class="ibo-session col-8">'. $text .'</div>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      return; 
    }
    
    echo '<div class="row">';
    echo '<div class="ibo-agenda-item col-12 col-md-10 offset-md-1">';
    echo '<div class="ibo-headline-bar row">';
    echo '<div class="ibo-time col-4">'. $timeSpan .'</div>';
    echo '<div class="ibo-session col-8">'.'</div>';
    echo '</div>';

    echo '<div id="'. $className .'_wrapper" class="card ibo-agenda-item-body">';
      echo '<div class="ibo-agenda-card row no-gutters">'; 
        echo '<div class="col-2 col-md-2 d-flex offset-1 offset-md-2">'; 
          echo '<img src="img/speaker/'. $speakerImg .'" class="card-img d-block justify-content-center align-self-center" alt="Profilbild von '.$speakerName.'">';
        echo '</div>'; 
        echo '<div class="col-9 col-md-8 d-flex">';
          echo '<div class="ibo-agenda-card-body card-body justify-content-center align-self-center mr-4">';
            echo '<p class="ibo-speaker">'. $speakerName;
              echo '<span class="ibo-location ibo-nobreak"> | Raum '. $roomNum .'</span>';
            echo '</p>';
            echo '<p class="ibo-topic">'. $text .'</p>';
          echo '</div>';
        echo '</div>';
      echo '</div>';
      echo '<div id="'.$className.'_bookmbtn" class="ibo-bookmbtn"><i onclick="bookmarkController.toggleBookmark('.$itemNumber.', false, 0);" class="far fa-bookmark"></i></div>'; 
      echo '<div id="'.$className.'_speakerlink" class="ibo-speakerlink"><a href="speakerprofile.php?speakerid='.$speakerId.'&speakername='.$speakerName.'"><i class="fas fa-user-tie"></i></a></div>'; 
    echo '</div>';

    echo '</div>';
    echo '</div>';

  }

  /**
   * Stellt eine gleichzeitig stattfindende Gruppe von Programmpunkten dar 
   *
   * @param   Array $agenda - Array mit Objekten der darzustellenden AgendaSlots
   * @param   int $itemNumber - Nummer des aktuellen AgendaSlots
   * @author  Philipp Wiens 
   */   
  public function displayAgendaStreamGroup($agenda, $itemNumber){
    $className1 = 'item' . $itemNumber;
    $className2 = 'item' . ($itemNumber+1);
    $className3 = 'item' . ($itemNumber+2);

    echo '<div class="row">';
      echo '<div class="ibo-agenda-item col-12 col-md-10 offset-md-1">';
        echo '<div class="ibo-headline-bar row">';
          echo '<div class="ibo-time col-4">10:45 - 11:30</div>';
          echo '<div class="ibo-session ibo-italic col-8">Bitte wählen Sie aus:</div>';
        echo '</div>';
        echo '<div class="ibo-stream-select row pt-2 pl-md-3">';
          echo '<p>zeigen / verbergen: ';
            echo '<span class="ibo-nobreak">';
              echo '<a data-toggle="collapse" href="#'. $className1 .'" role="button" aria-expanded="true" aria-controls="'. $className1 .'"><span>Stream A</span></a> | ';
              echo '<a data-toggle="collapse" href="#'. $className2 .'" role="button" aria-expanded="false" aria-controls="'. $className2 .'"><span>Stream B</span></a> | ';
              echo '<a data-toggle="collapse" href="#'. $className3 .'" role="button" aria-expanded="false" aria-controls="'. $className3 .'"><span>Stream C</span></a>';
            echo '</span>';
          echo '</p>';
        echo '</div>';

    $k = 0;
    for($i = $itemNumber; $i <= ($itemNumber+2); $i++){
      $className = 'item' . $i;
      $position = $i - $itemNumber; 
      
      $currentSlot = $agenda[$i]; 

      $speakerName = $currentSlot->speakerName; 
      $speakerId = $currentSlot->speakerId; 

      $letters = array('A', 'B', 'C'); 

      echo '<div class="collapse show" id="'. $className .'">';
        echo '<div id="'. $className .'_wrapper" class="card ibo-agenda-stream-item-body">';
          echo '<div class="ibo-agenda-card row no-gutters d-flex">';
            echo '<div class="ibo-agenda-letter col-1 col-md-2 justify-content-center align-self-center pr-1">'. $letters[$k] .'</div>';
            echo '<div class="col-2 col-md-2 d-flex">'; 
              echo '<img src="img/speaker/'. $agenda[$i]->speakerImg .'" class="card-img d-block justify-content-center align-self-center" alt="Profilbild '.$agenda[$i]->speakerName.'">';
            echo '</div>';
            echo '<div class="col-9 col-md-8 d-flex">';
              echo '<div class="ibo-agenda-card-body card-body justify-content-center align-self-center mr-3">';
                echo '<p class="ibo-speaker">'. $agenda[$i]->speakerName;
                  echo '<span class="ibo-location ibo-nobreak"> | Raum '. $agenda[$i]->roomNum .'</span>';
                echo '</p>';
                echo '<p class="ibo-topic">'. $agenda[$i]->text .'</p>';
                
                echo '<div id="'.$className.'_bookmbtn" class="ibo-bookmbtn"><i onclick="bookmarkController.toggleBookmark('.$i.', true, '.$position.');" class="far fa-bookmark"></i></div>'; 
                echo '<div id="'.$className.'_speakerlink" class="ibo-speakerlink"><a href="speakerprofile.php?speakerid='.$speakerId.'&speakername='.$speakerName.'"><i class="fas fa-user-tie"></i></a></div>'; 

              echo '</div>';
            echo '</div>';
          echo '</div>';
        echo '</div>';
      echo '</div>';

      $k++; 

    }

    echo '</div>';
    echo '</div>';
  }

}