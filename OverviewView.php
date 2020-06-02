<?php 

/**
 * Klasse OverviewView 
 *
 * View-Klasse für die Darstellung der Einzelansicht eines Events 
 *
 * @author  Philipp Wiens 
 */

class OverviewView {
  public $eventid; 
  public $currentEvent;

  public function __construct($eventid){
    $this->eventid  = $eventid; 

  }

  /**
   * Stellt den Inhalt des Content-Bereichs dar und verwendet dafür u.a. die folgenden Methoden 
   *
   * @param   Object $databaseHandler - das DatabaseHandler-Objekt 
   * @author  Philipp Wiens 
   */       
  public function displayContent($databaseHandler){
    $resultCurrentEvent = $databaseHandler->fetchDataForSingleEvent('ibo_seminar', $this->eventid);   
            
    $currentEventController = new EventController(); 
    $currentEvent = $currentEventController->saveItemAsObject($resultCurrentEvent);  
    $this->currentEvent = $currentEvent; 

    echo '<div class="container">'; 

      echo '<div class="row">';
        echo '<div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 px-4 my-2 my-md-3">';  
          $this->displayWelcomeText(); 
        echo '</div>'; 
      echo '</div>'; 

      echo '<div class="row">';
        echo '<div class="col-12 col-md-8 col-lg-6 offset-md-2 offset-lg-3">';
          $currentEventController->displayInfoSection($currentEvent); 
        echo '</div>'; 
      echo '</div>';
      echo '<div class="row px-md-5 my-lg-3">';
        echo '<div class="col-12 col-md-10 col-lg-6 offset-md-2 offset-lg-0 m-0 mb-3 px-md-5">'; 
          
            $homeView = new HomeView(); 
            $homeView->displayContactInfo('Enrico Sundermaier', 'unsplash_speaker_placeholder.jpg', '+49 641 98210-700', 'info@ibo.de'); 
          
        echo '</div>'; 
        echo '<div class="col-12 col-lg-5 d-none d-lg-block">';
        $this->displayButtonGroup(); 
        echo '</div>';
      echo '</div>'; 

      echo '<div class="row">';
        echo '<div class="col-12 col-md-12 offset-md-0 col-lg-8 offset-lg-2 order-1 my-2">'; 
          $resultAgenda = $databaseHandler->fetchDataForSingleEvent('SemSlot', $this->eventid); 

          $agendaController = new AgendaController(); 
          $agenda = $agendaController->saveItemsInArray($resultAgenda); 
          
          $agendaController->displayItemSection($agenda); 

        echo '</div>'; 
        echo '<div class="col-12 col-lg-2 offset-lg-0 order-2 d-lg-none">'; 
          
          $this->displayButtonGroup(); 
          
        echo '</div>'; 
      echo '</div>'; 

      echo '<div class="row">';
        echo '<div class="col-12 col-lg-7 px-0">';
          $currentEventController->displayMap(); 
        echo '</div>';
        echo '<div class="col-12 col-md-8 col-lg-5 offset-md-2 offset-lg-0 pb-3 mt-lg-5 pt-lg-2">';
          $resultHotelInfo = $databaseHandler->fetchDataForHotelInfo($this->eventid); 
          
          $hotelInfoController = new HotelInfoController(); 
          
          $hotelInfoItems = $hotelInfoController->saveItemsInArray($resultHotelInfo); 
          $hotelInfoController->displayItemSection($hotelInfoItems); 
        echo '</div>';
    echo '</div>';

    echo '</div>'; 

    return $agenda; 
  }

  /**
   * Stellt den Willkommen-Text dar 
   *
   * @author  Philipp Wiens 
   */   
  public function displayWelcomeText(){

        echo '<p class="ibo-welcome-text">'; 
          echo '<span class="ibo-welcome-text-highlight">';
          echo 'Herzlich willkommen! ';
          echo '</span><br><br>';
          echo $this->currentEvent->text2; 
        echo '</p>'; 
  }

  /**
   * Stellt die Buttons dar 
   *
   * @author  Philipp Wiens 
   */   
  public function displayButtonGroup(){
    $currentEvent = $this->currentEvent;
    $title = $currentEvent->title; 

    $atCost; 
    if(isset($currentEvent->fee) && $currentEvent->fee != ''){
        $atCost = 'kostenpflichtig'; 
    } else {
        $atCost = 'kostenlos'; 
    }
    $city = $currentEvent->city;
    $date = $currentEvent->date;

    echo '<div class="p-5 py-lg-2 mx-0 mt-lg-5 ibo-button-group">'; 

      echo '<a href="registrationform.php?eventid='.$this->eventid.'&title='.$title.'&atCost='.$atCost.'&city='.$city.'&date='.$date.'" class="btn btn-danger btn-lg btn-block">Anmelden</a><br>';
      
      echo '<a href="#" class="btn btn-danger btn-lg btn-block disabled">Feedback</a>'; 

    echo '</div>'; 

  }



}