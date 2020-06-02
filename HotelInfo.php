<?php

/**
 * Klasse HotelInfo
 *
 * Objekt-Klasse für eine Hotel-bezogene Information zur Unterkunft
 *
 * @param   int $hotelid - ID der HotelInfo
 * @param   string $name - Name des Hotels
 * @param   string $phoneNum - Telefonnummer des Hotels
 * @param   string $website - Web-Adresse des Hotels
 * @param   string $fee - Unterkunftskosten, HTML-formatiert 
 * @param   string $keyword - Stichwort bei Buchung
 * @param   int $numRooms - Anzahl reservierter Zimmer
 * @author  Philipp Wiens 
 */

class HotelInfo {
  public $hotelid; 
  public $name; 
  public $phoneNum; 
  public $website; 
  public $fee; 
  public $keyword; 
  public $numRooms; 
  
  public function __construct($hotelid, $name, $phoneNum, $website, $fee, $keyword, $numRooms) {
    $this->hotelid  = $hotelid; 
    $this->name  = $name; 
    $this->phoneNum  = $phoneNum; 
    $this->website  = $website; 
    $this->fee  = $fee; 
    $this->keyword  = $keyword; 
    $this->numRooms  = $numRooms; 
  }
}
