<?php

/**
 * Klasse AgendaSlot
 *
 * Objekt-Klasse für einen Veranstaltungs-Zeitblock
 *
 * @param   int $slotId - ID des Zeitblocks
 * @param   int $eventId - ID der Veranstaltung
 * @param   string $text - darstellender Text 
 * @param   string $roomNum - Raum-Nummer, als Zeichenkette 
 * @param   string $startTime - Startuhrzeit
 * @param   string $endTime - Enduhrzeit
 * @param   int $speakerId - ID des Referenten 
 * @param   string $speakerName - Name des Referenten
 * @param   string $speakerImg - Bild-Dateiname des Referenten 
 * @param   string $speakerCompany - Unternehmen des Referenten (weicht nur bei externen von 'ibo Software GmbH' ab)
 * @param   string $speakerPosition - Berufsbezeichnung/Unternehmensposition des Referenten
 * @param   string $description - ausführliche Beschreibung des Zeitblocks 
 * @author  Philipp Wiens 
 */

class AgendaSlot {
  public $slotId; 
  public $eventId; 
  public $text; 
  public $roomNum; 
  public $startTime; 
  public $endTime; 
  public $speakerId; 
  public $speakerName; 
  public $speakerImg; 
  public $speakerCompany; 
  public $speakerPosition; 
  public $description; 

  public function __construct($slotId, $eventId, $text, $roomNum, $startTime, $endTime, $speakerId, $speakerName, $speakerImg, $speakerCompany, $speakerPosition, $description) {
    $this->slotId  = $slotId; 
    $this->eventId = $eventId; 
    $this->text = $text; 
    $this->roomNum = $roomNum; 
    $this->startTime = $startTime; 
    $this->endTime = $endTime; 
    $this->speakerId = $speakerId; 
    $this->speakerName = $speakerName; 
    $this->speakerImg = $speakerImg; 
    $this->speakerCompany = $speakerCompany; 
    $this->speakerPosition = $speakerPosition; 
    $this->description = $description; 
  }
}