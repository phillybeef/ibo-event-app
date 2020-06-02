<?php 

/**
 * Klasse HeroSection 
 *
 * Stellt ein Hero-Bild dar, optional mit Live-Typing-Laufschrift.
 *
 * @param   string $imgName - der Dateiname des Hintergrundbildes im Verzeichnis 'img'
 * @param   boolean $displayTypedClaim - ob der ibo-Claim in Live-Typing-Laufschrift dargestellt werden soll. Hinweis: Dafür müssen zwei JS-Referenzen eingebunden werden (typed.js (extern) und typedContainer.js (intern)), siehe index.php 
 * @param   string $backgroundPosition - CSS-Anweisung für die Verankerung des Hintergrunds: 'top', 'center', 'bottom' 
 * @author  Philipp Wiens 
 */

class HeroSection {

  private $imgName; 
  private $displayTypedClaim; 
  private $backgroundPosition; 

  public function __construct($imgName, $displayTypedClaim, $backgroundPosition) {
    $this->imgName = $imgName; 
    $this->displayTypedClaim = $displayTypedClaim; 
    $this->backgroundPosition = $backgroundPosition; 
  }

  /**
   * Ausgabe des HTML-Code für den Seitenblock 'HeroSection' mit den der Klasse übergebenen Attributen
   *
   * @author  Philipp Wiens 
   */       
  public function displayHeroSection(){
 
    echo '<div class="container">';    

      echo '<div style="background-image: url(\'img/'. $this->imgName .'\');background-position:'. $this->backgroundPosition .';" alt="ibo - Wir organisieren Zukunft." class="jumbotron ibo-hero-section">';

      if($this->displayTypedClaim == true) {
        
        $this->displayTypedClaim(); 

      }

      echo '</div>';
    echo '</div>';

  }

  /**
   * Ausgabe des HTML-Code für die Live-Typing-Laufschrift 
   *
   * @author  Philipp Wiens 
   */     
  public function displayTypedClaim(){
  
    echo '<div class="ibo-typed-claim-wrapper">';
      echo '<div id="typed-strings">';
        echo '<p>Wir organisieren Suver</p>';
        echo '<p>Wir organisieren Souveränität.</p>';
        echo '<p>Wir organisieren Effizienz.</p>';
        echo '<p>Wir organisieren Vorsprung.</p>';
        echo '<p>Wir organisieren <b>Zukunft</b>.</p>';
      echo '</div>';
    echo '<span class="ibo-typed-claim" id="typed"></span>';
    echo '</div>';
  
  }

}