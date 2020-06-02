/**
 * BookmarkSet
 * 
 * Repräsentiert alle Markierungen auf den AgendaSlots einer Veranstaltung 
 * 
 * @constructor
 * @param {number} eventid - ID der Veranstaltung
 * @param {number} numOfItems - Gesamtanzahl an AgendaSlots 
 * @param {number} itemStates - Array mit Bool-Werten 
 * @author Philipp Wiens
 */

function BookmarkSet(eventid, numOfItems) {

  this.eventid = eventid; 
  this.itemStates = new Array(numOfItems-1); 
  
  for(var i = 0; i < numOfItems; i++){
    this.itemStates[i] = false; 
  }
}