<?php

/**
 * Klasse Speaker
 *
 * Objekt-Klasse für einen Referenten
 *
 * @param   int $speakerid - ID des Referenten
 * @param   string $name - Name des Referenten
 * @param   string $company - Unternehmen des Referenten
 * @param   string $position - Berufsbezeichnung/Unternehmensposition des Referenten
 * @param   string $phoneNum - Telefonnummer des Referenten
 * @param   string $photo - Bild-Dateiname des Referenten
 * @param   string $quote - Zitat des Referenten
 * @param   string $about - Abschnitt 'Über mich', optional HTML-formatiert
 * @param   string $career - Abschnitt 'Werdegang', optional HTML-formatiert
 * @param   string $projects - Abschnitt 'Projekte', optional HTML-formatiert
 * @param   string $topics - Abschnitt 'Themen', optional HTML-formatiert
 * @param   string $freeText1 - optionaler Text
 * @param   string $freeText2 - optionaler Text
 * @author  Philipp Wiens 
 */

class Speaker {
  public $speakerid; 
  public $name; 
  public $company; 
  public $position; 
  public $phoneNum; 
  public $photo; 
  public $quote; 
  public $about; 
  public $career; 
  public $projects; 
  public $topics; 
  public $freeText1; 
  public $freeText2; 
  
  public function __construct($speakerid, $name, $company, $position, $phoneNum, $photo, $quote, $about, $career, $projects, $topics, $freeText1, $freeText2) {
    $this->speakerid  = $speakerid; 
    $this->name  = $name; 
    $this->company  = $company; 
    $this->position  = $position; 
    $this->phoneNum  = $phoneNum; 
    $this->photo  = $photo; 
    $this->quote  = $quote; 
    $this->about  = $about; 
    $this->career  = $career; 
    $this->projects  = $projects; 
    $this->topics  = $topics; 
    $this->freeText1  = $freeText1; 
    $this->freeText2  = $freeText2; 
    
  }
}
