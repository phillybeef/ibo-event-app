<?php 

/**
 * Klasse RegistrationController 
 *
 * Wertet das Anmeldeformular aus, wandelt die Eingabedaten in ein Registration-Objekt um und sendet sie per Mail an einen Empfänger 
 *
 * @param   int $eventid - ID der Veranstaltung 
 * @param   string $title - Titel der Veranstaltung 
 * @param   boolean $atCost - kostenlos oder nicht? 
 * @param   string $city - Stadt, in der die Veranstaltung stattfindet 
 * @param   string $date - Datum der Veranstaltung 
 * @param   Object $registration - Registration-Objekt 
 * @author  Philipp Wiens 
 */

class RegistrationController {
  public $eventid; 
  public $title; 
  public $atCost; 
  public $city; 
  public $date; 
  public $registration; 
  
  public function __construct($eventid, $title, $atCost, $city, $date){
    $this->eventid  = $eventid; 
    $this->title  = $title; 
    $this->atCost  = $atCost; 
    $this->city  = $city; 
    $this->date  = $date; 

  }

  /**
   * Wandelt ein Datenbank-Objekt (item) in ein Registration-Objekt (object) um 
   *
   * @author  Philipp Wiens 
   */     
  public function itemToObject(){
    
    $this->registration = new Registration($this->eventid, $_POST["gender"], $_POST["title"], $_POST["firstName"], $_POST["lastName"], $_POST["streetOrPostbox"], $_POST["zipCode"], $_POST["city"], $_POST["email"], $_POST["newsletterCheck"], $_POST["dataprotectionCheck"]); 

  }

  /**
   * Sendet die Anmeldung per Mail 
   *
   * @author  Philipp Wiens 
   */     
  public function submitViaEmail($email){
    $to = $email; 
    $subject = 'Anmeldung Event';
    $message = $this->printRegistration(); 
    $message = wordwrap($message,70); 
    $from = 'From: registration@ibo-events.de'; 

    mail($to, $subject, $message, $from); 

  }

  /**
   * Gibt die Anmeldedaten aus 
   *
   * @author  Philipp Wiens 
   */     
  public function printRegistration(){
      $printReceiveNewsletter;   
      $printAcceptPrivacySt; 

      if ($this->registration->receiveNewsletter == true) {
        $printReceiveNewsletter = 'Newsletter gewünscht.';
      } else {
        $printReceiveNewsletter = 'Newsletter nicht gewünscht.';
      }

      if ($this->registration->acceptPrivacySt == true) {
        $printAcceptPrivacySt = 'Datenschutz akzeptiert.';
      } else {
        $printAcceptPrivacySt = 'Datenschutz nicht akzeptiert.';
      }

      return 'Event-ID: ' . $this->registration->eventId . '<br>' . 'Anrede: ' . $this->registration->formOfAddress . '<br>'. 'Titel: ' . $this->registration->title . '<br>' . 'Vorname: ' . $this->registration->firstName . '<br>' . 'Nachname: ' . $this->registration->lastName . '<br>' . 'Straße / Postfach: ' . $this->registration->streetOrPostbox . '<br>' .'PLZ: ' . $this->registration->zipCode . '<br>' . 'Stadt: ' . $this->registration->city . '<br>' . 'E-Mail: ' . $this->registration->email . '<br>' . $printReceiveNewsletter . '<br>' . $printAcceptPrivacySt . '<br>'; 
      
      

  }

  /**
   * Stellt den Content-Bereich der Anmeldeseite dar 
   *
   * @author  Philipp Wiens 
   */     
  public function displayContent(){

    echo '<div class="container">'; 

      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $this->itemToObject(); 
        $this->submitViaEmail('philipp.wiens@iem.thm.de'); 

        echo '<div class="row mb-5">';
          echo '<div class="col-12 col-md-6 offset-md-3">';

            echo '<p>Vielen Dank, ihre Anmeldung wurde an die E-Mail-Adresse * gesendet.</p>'; 

            echo '<p><h5>Ihre Daten:</h5>'; 
              $printedRegistration = $this->printRegistration(); 
              echo $printedRegistration;
            echo '</p>';

          echo '</div>';
        echo '</div>';

      } else {
        
        $this->displayForm(); 
        
      }
    
    echo '</div>'; 

  }

  /**
   * Stellt das Formular dar 
   *
   * @author  Philipp Wiens 
   */     
  public function displayForm(){
    $dateFormatted = strtotime($this->date); 
    $dateGerman = strftime("am %A, dem %d. %B %Y", $dateFormatted); 

    echo '<div class="row my-5">';
      echo '<div class="col-10 col-md-8 col-lg-6 offset-md-2 offset-lg-3 offset-1">';

        echo '<form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'?eventid='.$this->eventid.'&title='.$this->title.'" method="post">';
          echo '<div class="form-group mb-5">';
            echo '<div class="form-check">';
                echo '<strong>Hiermit melde ich mich zur '.$this->atCost.'en Veranstaltung  <span class="ibo-red">'.$this->title.'</span> '.$dateGerman.' in '.$this->city.' an.</strong>';

              echo '</div>';
            echo '</div>';
                echo '<div class="form-row">';
                echo '<div class="form-group col-md-6">';
                echo '<label for="gender">Anrede</label>';
                echo '<select class="form-control ibo-input" id="gender" name="gender">';
                echo '<option></option>';
                echo '<option>Frau</option>';
                echo '<option>Herr</option>';
                echo '</select>';
                echo '</div>';
                echo '<div class="form-group col-md-6">';
                echo '<label for="title">Titel</label>';
                echo '<input class="form-control ibo-input" type="text" id="title" name="title">';
                echo '</div>';
                echo '</div>';
                echo '<div class="form-row">';
                echo '<div class="form-group col-md-6">';
                echo '<label for="firstName">Vorname</label>';
                echo '<input type="text" class="form-control ibo-input" id="firstName" name="firstName">';
                echo '</div>';
                echo '<div class="form-group col-md-6">';
                echo '<label for="lastName">Nachname</label>';
                echo '<input type="text" class="form-control ibo-input" id="lastName" name="lastName">';
                echo '</div>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="streetOrPostbox">Straße oder Postfach</label>';
                echo '<input type="text" class="form-control ibo-input" id="streetOrPostbox" name="streetOrPostbox">';
                echo '</div>';
                echo '<div class="form-row">';
                echo '<div class="form-group col-md-4">';
                echo '<label for="zipCode">PLZ</label>';
                echo '<input type="text" class="form-control ibo-input" id="zipCode" name="zipCode">';
                echo '</div>';
                echo '<div class="form-group col-md-8">';
                echo '<label for="city">Ort</label>';
                echo '<input type="text" class="form-control ibo-input" id="city" name="city">';
                echo '</div>';
                        
                        
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="email">Email (geschäftlich)</label>';
                echo '<input type="email" class="form-control ibo-input" id="email" name="email">';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<div class="form-check">';
                echo '<input class="form-check-input" type="checkbox" id="newsletterCheck" name="newsletterCheck">';
                echo '<label class="form-check-label" for="newsletterCheck">';
                echo 'Ja, ich bin damit einverstanden, dass die ibo Gruppe mich per Newsletter auf dem Laufenden hält. Ich kann mich jederzeit vom Newsletter abmelden.';
                echo '</label>';
                echo '</div>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<div class="form-check">';
                echo '<input class="form-check-input" type="checkbox" id="dataprotectionCheck" name="dataprotectionCheck">';
                echo '<label class="form-check-label" for="dataprotectionCheck">';
                echo 'Ja, ich habe die Datenschutzerklärung zur Kenntnis genommen und bin damit einverstanden, dass die von mir angegebenen Daten elektronisch erhoben und gespeichert werden. Meine Daten werden dabei nur streng zweckgebunden zur Bearbeitung und Beantwortung meiner Anfrage benutzt. Mit dem Absenden des Kontaktformulars erkläre ich mich mit der Verarbeitung einverstanden. Ich kann diese Einwilligung jederzeit widerrufen. Dazu reicht eine formlose Mitteilung per E-Mail an info@ibo.de. Die Rechtmäßigkeit der bis zum Widerruf erfolgten Datenverarbeitungsvorgänge bleibt vom Widerruf unberührt.';
                echo '</label>';
              echo '</div>';
            echo '</div>';
            echo '<button type="submit" class="btn btn-danger ibo-red-btn mx-auto d-block mt-4">Jetzt anmelden</button>';
          echo '</form>';

        echo '</div>';
      echo '</div>';

  }

  

  

}