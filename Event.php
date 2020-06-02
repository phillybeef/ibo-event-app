<?php

/**
 * Klasse Event
 *
 * Objekt-Klasse für eine Veranstaltung
 *
 * @param   int $eventid - ID der Veranstaltung
 * @param   string $category - Kategorie der Veranstaltung 
 * @param   string $date - Datum 
 * @param   string $start - Startuhrzeit
 * @param   string $end - Enduhrzeit
 * @param   string $city - Stadt
 * @param   string $location - Austragsungsort
 * @param   string $title - Kurztitel der Veranstaltung
 * @param   string $titleTeaser - Überschriftstitel für Übersichtsdarstellung
 * @param   string $text1 - darstellender Text
 * @param   string $text2 - darstellender Text
 * @param   string $fee - Kosten, HTML-formatiert. Wenn kostenlos, dann leer. 
 * @author  Philipp Wiens 
 */

class Event {
  public $eventid; 
  public $category; 
  public $date; 
  public $start; 
  public $end; 
  public $city; 
  public $location; 
  public $title; 
  public $titleTeaser; 
  public $text1; 
  public $text2; 
  public $fee; 

  public function __construct($eventid, $category, $date, $start, $end, $city, $location, $title, $titleTeaser, $text1, $text2, $fee) {
    $this->eventid  = $eventid; 
    $this->category = $category; 
    $this->date = $date; 
    $this->start = $start; 
    $this->end = $end; 
    $this->city = $city; 
    $this->location = $location; 
    $this->title = $title; 
    $this->titleTeaser = $titleTeaser; 
    $this->text1 = $text1; 
    $this->text2 = $text2; 
    $this->fee = $fee; 
  }

}