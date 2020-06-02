<?php

/**
 * Klasse Registration
 *
 * Objekt-Klasse für eine Anmeldung
 *
 * @param   int $eventId - ID der Veranstaltung
 * @param   string $formOfAddress - Anrede
 * @param   string $title - Titel
 * @param   string $firstName - Vorname
 * @param   string $lastName - Nachname
 * @param   string $streetOrPostbox - Straße oder Postfach
 * @param   string $zipCode - Postleitzahl
 * @param   string $city - Stadt
 * @param   string $email - E-Mail-Adresse
 * @param   boolean $receiveNewsletter - ob der Newsletter gewünscht ist 
 * @param   boolean $acceptPrivacySt - ob die Datenschutzbestimmungen akzeptiert sind
 * @author  Philipp Wiens 
 */

class Registration {
  public $eventId; 
  public $formOfAddress; 
  public $title; 
  public $firstName; 
  public $lastName; 
  public $streetOrPostbox; 
  public $zipCode; 
  public $city; 
  public $email; 
  public $receiveNewsletter; 
  public $acceptPrivacySt; 

  
  public function __construct($eventId, $formOfAddress, $title, $firstName, $lastName, $streetOrPostbox, $zipCode, $city, $email, $receiveNewsletter, $acceptPrivacySt) {
    $this->eventId  = $eventId; 
    $this->formOfAddress  = $formOfAddress; 
    $this->title  = $title; 
    $this->firstName  = $firstName; 
    $this->lastName  = $lastName; 
    $this->streetOrPostbox  = $streetOrPostbox; 
    $this->zipCode  = $zipCode; 
    $this->city  = $city; 
    $this->email  = $email; 
    $this->receiveNewsletter  = $receiveNewsletter; 
    $this->acceptPrivacySt  = $acceptPrivacySt; 
    
  }
}
