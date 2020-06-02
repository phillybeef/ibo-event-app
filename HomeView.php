<?php 

/**
 * Klasse HomeView 
 *
 * View-Klasse für die Darstellung des Content-Bereichs der Startseite 
 *
 * @author  Philipp Wiens 
 */

class HomeView {

  /**
   * Stellt den Inhalt des Content-Bereichs dar und verwendet dafür u.a. die folgenden Methoden 
   *
   * @param   Object $databaseHandler - das DatabaseHandler-Objekt 
   * @author  Philipp Wiens 
   */       
  public function displayContent($databaseHandler){
    echo '<div class="container">'; 

    $this->displayTopSection(); 

    $resultFutureEvents = $databaseHandler->fetchDataForMultipleEvents('ibo_seminar', 'ASC', true); 
        
    $futureEventController = new EventController(); 
    $futureEvents = $futureEventController->saveItemsInArray($resultFutureEvents); 

    $futureEventController->displayItemSection($futureEvents, true);

    $resultPastEvents = $databaseHandler->fetchDataForMultipleEvents('ibo_seminar', 'DESC', false); 

    $pastEventController = new EventController(); 
    $pastEvents = $pastEventController->saveItemsInArray($resultPastEvents); 

    $pastEventController->displayItemSection($pastEvents, false);

    echo '</div>  '; 
  }

  /**
   * Stellt ersten Seitenbereich mit Willkommen-Text und Kontakt-Info dar 
   *
   * @author  Philipp Wiens 
   */       
  public function displayTopSection(){

    echo '<div class="row m-1 mt-md-5 mb-md-3 ml-md-3 mr-md-5">';
    echo '<div class="col-12 col-md-12 col-lg-7">';
    
      $this->displayWelcomeText(); 

    echo '</div>';
    echo '<div class="col-12 col-md-8 offset-md-2 offset-lg-0 col-lg-5 py-3 px-0">';

      $this->displayContactInfo('Enrico Sundermaier', 'unsplash_speaker_placeholder.jpg', '+49 641 98210-700', 'info@ibo.de'); 

    echo '</div>';
    echo '</div>';

  }

  /**
   * Stellt den Willkommen-Text dar 
   *
   * @author  Philipp Wiens 
   */     
  public function displayWelcomeText(){

        echo '<p class="ibo-welcome-text pr-lg-3">';
          echo '<span class="ibo-welcome-text-highlight">ibo live erleben – Lernen Sie uns persönlich kennen.</span> <br><br>Es gibt viele Wege, ibo live zu erleben. Roadshows, Praxistage, Trendforen oder die iboCON – treffen Sie uns auf den ibo-Veranstaltungen. Erleben Sie uns als Aussteller, Redner und Networker bei Ausstellungen, Messen, Kongressen, Fachtagungen oder Barcamps. ';
          echo '<span class="ibo-welcome-text-highlight">Wir freuen uns auf Sie.</span>';          
        echo '</p>';
      

  }

  /**
   * Stellt die Kontakt-Info dar 
   *
   * @param string $name - Name der Kontaktperson 
   * @param string $img - Name der Bilddatei 
   * @param string $phoneNum - Telefonnummer 
   * @param string $email - E-Mail-Adresse 
   * @author  Philipp Wiens 
   */     
  public function displayContactInfo($name, $img, $phoneNum, $email){
      
    echo '<div class="ibo-contact-box-wrapper px-4 py-3 px-md-5 px-lg-1 py-lg-1 mb-3">'; 

        echo '<h3 class="ibo-anth">Sie haben Fragen?</h3>'; 
        echo '<div class="row ibo-contact-box">';
                
          echo '<div class="col-4 d-flex py-md-3">';
            echo '<img src="img/'.$img.'" class="card-img d-block justify-content-center align-self-center" alt="Profilbild von '.$name.'">';
          echo '</div>';
          echo '<div class="col-8 ibo-contact-box-text justify-content-center align-self-center">';
            
            echo '<span>'.$name.'</span><br>';
            echo '<i class="fas fa-phone-alt"></i> <a href="tel:'.$phoneNum.'">'.$phoneNum.'</a><br>';
            echo '<i class="fas fa-at"></i> <a href="mailto:'.$email.'">'.$email .'</a>';
          echo '</div>';
                        
        echo '</div>';
      
    echo '</div>'; 

  }

}