<?php

/**
 * Klasse DatabaseHandler 
 *
 * Ruft Daten von der Datenbank ab und stellt sie der Anwendung zur Verfügung 
 *
 * @param   string $dbServername - Name des Datenbank-Servers
 * @param   string $dbUsername - Name des DB-Benutzers 
 * @param   string $dbPassword - Passwort des DB-Benutzers
 * @param   string $dbName - Name der Datenbank 
 * @param   Object $connection - MySQLi-Objekt der Datenbank-Verbindung
 * @author  Philipp Wiens 
 */

class DatabaseHandler {

    private $dbServername; 
    private $dbUsername; 
    private $dbPassword; 
    private $dbName; 
    private $connection; 

    public function __construct($dbServername, $dbUsername, $dbPassword, $dbName) {

      $this->dbServername = $dbServername; 
      $this->dbUsername = $dbUsername; 
      $this->dbPassword = $dbPassword; 
      $this->dbName = $dbName; 

    }

    /**
    *
    * Stellt die Datenbank-Verbindung her 
    *
    * @author  Philipp Wiens 
    */
    public function connectToDatabase() {

      $this->connection = new mysqli($this->dbServername, $this->dbUsername, $this->dbPassword, $this->dbName); 

      if ($this->connection->connect_errno) {
        echo "Datenbank-Verbindung funktioniert nicht: " . $this->connection->connect_error;
      }

      $this->connection->set_charset("utf8");

    }

    /**
    *
    * Führt eine DB-Abfrage für eine Veranstaltung aus
    *
    * @param string $table - Name der DB-Tabelle für die Abfrage ('ibo_seminar', 'SemSlot')
    * @param int $eventid - ID der Veranstaltung
    * @return Array $result - Daten der Abfrage 
    * @author  Philipp Wiens 
    */
    public function fetchDataForSingleEvent($table, $eventid) {
      
      $sql;

      if($table == 'ibo_seminar'){
        $sql = "SELECT * FROM ibo_seminar WHERE seminarid = ". $eventid . ";";
      }

      if($table == 'SemSlot'){
        $sql = "SELECT SemSlot.SlotId, SemSlot.SemId, SemSlot.Txt, SemSlot.RaumNr, SemSlot.DatVon, SemSlot.DatBis, SemSlot.DozId, Prs.Name, Prs.Foto, Prs.Unternehmen, Prs.Position, SemSlot.Besch FROM SemSlot LEFT JOIN Prs ON SemSlot.DozId = Prs.PrsId WHERE SemId=". $eventid ."; ";
      }

      $result = $this->connection->query($sql); 

      return $result; 
    }

    /**
    *
    * Führt eine DB-Abfrage für alle Veranstaltungen aus
    *
    * @param string $table - Name der DB-Tabelle für die Abfrage 
    * @param string $sorting - auf- oder absteigende Sortierung: 'ASC', 'DESC'
    * @param boolean $future - legt fest, ob Daten in der Zukunft oder in der Vergangenheit liegen
    * @return Array $result - Daten der Abfrage 
    * @author  Philipp Wiens 
    */
    public function fetchDataForMultipleEvents($table, $sorting, $future){
      
      $pastOrFutureOperator;  
      if($future == true) {
        $pastOrFutureOperator = '>='; 
      } else {
        $pastOrFutureOperator = '<'; 
      }

      $today = date("Y-m-d"); 

      $sql = "SELECT * FROM " . $table ." WHERE datvon ". $pastOrFutureOperator ." '". $today ."' ORDER BY datvon ". $sorting .";";
      $result = $this->connection->query($sql); 

      return $result; 
    } 

    /**
    *
    * Führt eine DB-Abfrage für einen Referenten aus
    *
    * @param int $speakerid - ID des Referenten
    * @return Array $result - Daten der Abfrage 
    * @author  Philipp Wiens 
    */
    public function fetchDataForSpeaker($speakerid){
      
      $sql = "SELECT PrsId, Name, Unternehmen, Position, Tel, Foto, Zitat, UeberMich, Werdegang, Projekte, Themen, FreeText1, FreeText2 FROM Prs WHERE PrsId=" . $speakerid . ";"; 
      
      $result = $this->connection->query($sql); 
      
      return $result; 
    }

    /**
    *
    * Führt eine DB-Abfrage für die Hotelkontingent-Info für eine Veranstaltung aus
    *
    * @param int $eventid - ID der Veranstaltung
    * @return Array $result - Daten der Abfrage 
    * @author  Philipp Wiens 
    */
    public function fetchDataForHotelInfo($eventid){

      $sql = "SELECT HotelId, Name, TelNr, Url, Preis, Stichwort, AnzZimmer FROM SemHotel WHERE SemId=".$eventid.";";
      $result = $this->connection->query($sql); 
      return $result; 
    }
      
}