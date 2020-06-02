<?php 

/**
 * Klasse SpeakerController 
 *
 * Führt Operationen mit Speaker-Objekten aus, stellt Referenten in Detailansicht dar
 *
 * @param   array $events - Array für Event-Objekte 
 * @author  Philipp Wiens 
 */

class SpeakerController {

  private $speakerObject; 

  /**
   * Wandelt ein Datenbank-Objekt (item) in ein Speaker-Objekt (object) um 
   *
   * @param   Object $row - DB-Abfrage-Objekt
   * @return  Object $speaker - Speaker-Objekt
   * @author  Philipp Wiens 
   */     
   public function itemToObject($row){
    
    $speaker = new Speaker($row['PrsId'], $row['Name'], $row['Unternehmen'], $row['Position'], $row['Tel'], $row['Foto'], $row['Zitat'], $row['UeberMich'], $row['Werdegang'], $row['Projekte'], $row['Themen'], $row['FreeText1'], $row['FreeText2']); 
    
    return $speaker; 
  }

  /**
   * Ruft einen Datensatz ab und speichert diesen als Speaker-Objekt 
   *
   * @param   Object $result - Datenobjekt der DB-Abfrage
   * @return  Object $event - Speaker-Objekt
   * @author  Philipp Wiens 
   */     
  public function saveItemAsObject($result){

    $row = $result->fetch_assoc();
    $speaker = $this->itemToObject($row); 

    return $speaker; 
  } 

  

  /**
   * Stellt einen Referenten in Detailansicht dar und verwendet dafür die weiteren Methoden
   *
   * @param   Object $speakerObject - aktuelles Speaker-Objekt
   * @author  Philipp Wiens 
   */   
   public function displayItemSection($speakerObject){
        $this->speakerObject = $speakerObject; 
        $paragraphHeadlineList = array("Über mich", "Werdegang", "Projekte", "Themen", "", ""); 
        $paragraphList = array("about", "career", "projects", "topics", "freeText1", "freeText2"); 
        $paragraphKey; 
        $paragraph; 

    echo '<div class="container">';
        echo '<div class="row mb-5 px-3 my-md-5 py-md-5">';
            echo '<div class="col-12 col-md-4 d-none d-md-block">'; 
        $this->displayPhoto(); 
            echo '</div>';
            echo '<div class="ibo-speaker-content col-12 col-md-8 my-3 my-md-0 px-3 py-0">';
        $this->displayHead(); 
            echo '<div class="d-md-none mb-5">'; 
        $this->displayPhoto(); 
            echo '</div>'; 

      for($i = 0; $i < 6; $i++) {
        
        $paragraphKey = $paragraphList[$i]; 
        $paragraphHeadline = $paragraphHeadlineList[$i];
        $paragraph = $speakerObject->$paragraphKey; 

        if(isset($paragraph) && $paragraph != ''){
          $this->displayItem($paragraph, $paragraphHeadline);
          
        }
      } 
         
            echo '</div>';
        echo '</div>';
    echo '</div>';

    
  }

  /**
   * Stellt das Foto eines Referenten für die Detailansicht dar
   *
   * @author  Philipp Wiens 
   */   
  public function displayPhoto(){
    echo '<img src="img/speaker/'.$this->speakerObject->photo.'" class="ibo-speaker-img" alt="Profilbild '. $this->speakerObject->name .'">';
  }

  /**
   * Stellt die Basisinformationen eines Referenten für die Detailansicht dar
   *
   * @author  Philipp Wiens 
   */  
  public function displayHead(){
    echo '<h2 class="mx-md-4">'.$this->speakerObject->name.'</h2>'; 
    echo '<p  class="mx-md-4"><span class="ibo-position">'.$this->speakerObject->position.'</span> <span class="ibo-nobreak ibo-tel"> | <a href="tel:'. $this->speakerObject->phoneNum .'">'.$this->speakerObject->phoneNum.'</a></span></p>';
    echo '<p class="d-block m-4"><span class="ibo-quote">'.$this->speakerObject->quote.'</span></p>';
  }

  /**
   * Stellt eine Themeneinheit für die Referenten-Detailansicht dar
   *
   * @param   string $paragraph - Bezeichnung des Abschnitts
   * @param   string $paragraphHeadline - Überschrift des Abschnitts
   * @author  Philipp Wiens 
   */  
  public function displayItem($paragraph, $paragraphHeadline){
    echo '<h4 class="my-3 mx-md-4">'.$paragraphHeadline.'</h4>'; 
    echo '<p class="d-block m-4">'.$paragraph.'</p>';
  }

}