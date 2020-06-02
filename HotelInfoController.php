<?php 

/**
 * Klasse HotelInfoController 
 *
 * Führt Operationen mit HotelInfo-Objekten aus, stellt Hotel-Informationen in Auflistungen dar 
 *
 * @param   array $hotelInfoItems - Array für HotelInfo-Objekte 
 * @author  Philipp Wiens 
 */

class HotelInfoController {

  private $hotelInfoItems = array(); 

  /**
   * Wandelt ein Datenbank-Objekt (item) in ein Event-Objekt (object) um 
   *
   * @param   Object $row - Datenobjekt der DB-Abfrage
   * @return  Object $hotelInfoObject - HotelInfo-Objekt
   * @author  Philipp Wiens 
   */     
   public function itemToObject($row){
    $hotelInfoObject = new HotelInfo($row['HotelId'], $row['Name'], $row['TelNr'], $row['Url'], $row['Preis'], $row['Stichwort'], $row['AnzZimmer']); 
    // var_dump($hotelInfoObject); 
    return $hotelInfoObject; 
    
  }

  /**
   * Speichert HotelInfo-Objekte im Array 
   *
   * @param   Object $result - Datensatz der DB-Abfrage
   * @return  Array $hotelInfoItems - Array mit HotelInfo-Objekten 
   * @author  Philipp Wiens 
   */   
  public function saveItemsInArray($result) {
    $i = 1; 
    while($row = $result->fetch_assoc()) {

        ${"hotelInfo" . $i} = $this->itemToObject($row); 

        $this->hotelInfoItems[] = ${"hotelInfo" . $i}; 
        $i++; 
    }

    return $this->hotelInfoItems; 

  }

  /**
   * Stellt einen Seitenblock mit Hotelinformationen dar 
   *
   * @param   Array $hotelInfoItems - Array mit allen darzustellenden HotelInfo-Objekten 
   * @author  Philipp Wiens 
   */   
   public function displayItemSection($hotelInfoItems){
    
    $slotNumber = count($hotelInfoItems); 
    $itemNumber = 0;
    
    echo '<h3 class="ibo-red">Hotel-Kontingente</h3>';
    echo '<div id="accordion">'; 
    
    if($slotNumber == 0) {
      echo '<div class="m-5 ibo-hotel-no-content">Es sind noch keine Hotelkontingente hinterlegt.</div>';
    }

    while($itemNumber < $slotNumber){
      
      
      $this->displayItem($itemNumber); 
      $itemNumber++; 

    }

    echo '</div>'; 

  }

  /**
   * Stellt einen HotelInfo-Objekt innerhalb des Seitenblocks dar 
   *
   * @param   int $itemNumber - Nummer des aktuellen HotelInfo-Objekts 
   * @author  Philipp Wiens 
   */   
  public function displayItem($itemNumber){
    
    $currentHotelInfo = $this->hotelInfoItems[$itemNumber]; 
    $show; 
    if($itemNumber == 0) {
      $show = 'show'; 
    } else {
      $show = ''; 
    }

    echo '<div class="card">'; 

      echo '<div id="heading'.$itemNumber.'" class="card-header ibo-hotel-item-header" >'; 
        echo '<h5 class="mb-0">'; 
          echo '<a data-toggle="collapse" data-target="#collapse'.$itemNumber.'" aria-expanded="true" aria-controls="collapse'.$itemNumber.'">'; 
           echo $currentHotelInfo->name; 
          echo '</a>'; 
        echo '</h5>'; 
      echo '</div>'; 

      echo '<div id="collapse'.$itemNumber.'" class="collapse '.$show.'" aria-labelledby="heading'.$itemNumber.'" data-parent="#accordion">'; 
        echo '<div class="card-body ibo-hotel-item-body">'; 
          echo '<p><i class="fas fa-home"></i><a href="http://'.$currentHotelInfo->website.'/" target="_blank">' .$currentHotelInfo->website .'</a></p>'; 
          echo '<p><i class="fas fa-phone-square-alt"></i><a href="tel:'.$currentHotelInfo->phoneNum .'">'.$currentHotelInfo->phoneNum .'</a></p>'; 
          echo '<p><i class="fas fa-euro-sign"></i> '.$currentHotelInfo->fee .'</p>'; 
          echo '<p class="ibo-keyword-hint">Bitte nennen Sie bei der Buchung das Stichwort <b>'.$currentHotelInfo->keyword.'</b>.</p>'; 
        echo '</div>'; 
      echo '</div>'; 

    echo '</div>'; 


    

  }
    
}