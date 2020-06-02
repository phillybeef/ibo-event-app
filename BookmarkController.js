/**
 * BookmarkController
 * 
 * Verwaltet das Anzeigen, Speichern und Laden von Markierungen der AgendaSlots 
 * 
 * @constructor
 * @param {number} eventid - ID der Veranstaltung
 * @param {number} numOfItems - Gesamtanzahl an AgendaSlots 
 * @param {Object} bookmarkSet - BookmarkSet-Objekt
 * @author Philipp Wiens
 */

function BookmarkController(eventid, numOfItems) {

  this.eventid = eventid; 
  this.numOfItems = numOfItems; 
  this.bookmarkSet; 
  
  /**
   * Erzeugt ein BookmarkSet
   * 
   * @author Philipp Wiens
   */
  this.createBookmarkSet = function(){
    if (this.numOfItems > 0) {
      this.bookmarkSet = new BookmarkSet(this.eventid, this.numOfItems); 
      /* for(var i = 0; i < numOfItems; i++){
        console.log(this.bookmarkSet.itemStates[i]); 
      } */
    }
    
  }

  /**
   * Setzt eine Lesezeichen-Markierung oder entfernt sie 
   * 
   * @param {number} itemNum - Nummer des aktuellen Eintrags 
   * @param {boolean} stream - Befindet sich der Eintrag in einem Stream? 
   * @param {number} position - Position im Stream: 0, 1, 2
   * @author Philipp Wiens
   */
  this.toggleBookmark = function(itemNum, stream, position){

    var firstStreamItemPos = itemNum - position; 
    var lastStreamItemPos = firstStreamItemPos + 2; 

    if(stream) {
      for(var i = firstStreamItemPos; i <= lastStreamItemPos; i++){ 

        var className = 'item' + i; 
        var buttonEle = document.getElementById(className + '_bookmbtn').children[0];
        var wrapperEle = document.getElementById(className + '_wrapper');

        if(i === itemNum) {

          if (this.bookmarkSet.itemStates[i] == false) {
            this.bookmarkSet.itemStates[i] = true; 
            buttonEle.className = 'fas fa-bookmark'; 
            buttonEle.style.color = '#e40134'; 
            wrapperEle.style.border = "2px solid #e40134"; 
            continue; 
            
          } else {
            this.bookmarkSet.itemStates[i] = false; 
            buttonEle.className = 'far fa-bookmark'; 
            buttonEle.style.color = '#e40134'; 
            wrapperEle.style.border = "1px solid #bacbd5";
          }

        } else {

          this.bookmarkSet.itemStates[i] = false; 
          buttonEle.className = 'far fa-bookmark'; 
          buttonEle.style.color = '#e40134'; 
          wrapperEle.style.border = "1px solid #bacbd5";
        }
        
      }
    }

    if(!stream){

      var className = 'item' + itemNum; 
      var buttonEle = document.getElementById(className + '_bookmbtn').children[0];
      var wrapperEle = document.getElementById(className + '_wrapper');

      if (this.bookmarkSet.itemStates[itemNum] == false) {
        this.bookmarkSet.itemStates[itemNum] = true; 
        buttonEle.className = 'fas fa-bookmark'; 
        buttonEle.style.color = '#e40134'; 
        wrapperEle.style.border = "2px solid #e40134"; 
        
      } else {
        this.bookmarkSet.itemStates[itemNum] = false; 
        buttonEle.className = 'far fa-bookmark'; 
        buttonEle.style.color = '#e40134'; 
        wrapperEle.style.border = "none";
      }
    }

    /* for(var i = 0; i < numOfItems; i++){
      console.log(this.bookmarkSet.itemStates[i]); 
    } */
    
  }

  /**
   * Speichert das die boolean-Werte des BookmarkSets in localStorage-Objekt des Browsers 
   * 
   * @author Philipp Wiens
   */
  this.saveBookmarkSet = function(){
    eventid = this.eventid; 

    var bookmarkSetSerialized = JSON.stringify(this.bookmarkSet.itemStates); 

    localStorage.setItem(eventid, bookmarkSetSerialized); 
    
  }

  /**
   * Lädt die boolean-Werte des localStorage-Objekts des Browsers und speichert sie im BookmarkSet-Objekt
   * 
   * @author Philipp Wiens
   */
  this.loadBookmarkSet = function(){
    
    var slotStates,
        slotStatesDeserialized,
        className,
        buttonEle,
        wrapperEle;

    if (localStorage.getItem(eventid) !== null) {
    
      // console.log('localStorage-Objekt existiert.');
      slotStates = localStorage.getItem(eventid);

      slotStatesDeserialized = JSON.parse(slotStates); 

      for(var i = 0; i < this.numOfItems; i++){

        if(slotStatesDeserialized[i] === true) {

          className = 'item' + i; 
          buttonEle = document.getElementById(className + '_bookmbtn').children[0];
          wrapperEle = document.getElementById(className + '_wrapper');

          buttonEle.className = 'fas fa-bookmark'; 
          buttonEle.style.color = '#e40134'; 
          wrapperEle.style.border = "2px solid #e40134"; 
          this.bookmarkSet.itemStates[i] = true; 

        } else {
          this.bookmarkSet.itemStates[i] = false; 
        }

      }

    } else {
      // console.log('localStorage-Objekt existiert NICHT.');
    }

    
  }

}