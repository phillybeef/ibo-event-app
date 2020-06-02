<?php 

/**
 * Klasse Navigation 
 *
 * View-Klasse für die Darstellung der Navigation 
 *
 * @param   string $mainPageTitle - Titel der Seite 
 * @param   string $subPageTitle - Titel der übergeordneten Seite
 * @author  Philipp Wiens 
 */

class Navigation {

  private $mainPageTitle; 
  private $subPageTitle; 

  public function __construct($mainPageTitle, $subPageTitle) {
    $this->mainPageTitle = $mainPageTitle; 
    $this->subPageTitle = $subPageTitle; 
    
  }

  /**
   * Stellt das Menü dar, abhängig vom Parameter, ob es sich um ein mobiles Gerät handelt
   *
   * @param   boolean $mobileScreen
   * @author  Philipp Wiens 
   */   
  public function displayBreadcrumbMenu($mobileScreen) {

    $linebreakOnMediumUp; 

    if($mobileScreen == true){
      $linebreakOnMediumUp = ''; 
    } else {
      $linebreakOnMediumUp = '<br>'; 
    }
    
    if($this->mainPageTitle != 'Home') {
      if(isset($this->subPageTitle) && $this->subPageTitle != '') { 
        
        echo '<a href="index.php"><i class="ibo-icon fas fa-home"></i></a> <i class="ibo-icon fas fa-angle-right"></i> <a href="#" class="ibo-subtitle-link">' . $this->mainPageTitle . $linebreakOnMediumUp .'</a>  <i class="ibo-icon fas fa-angle-right"></i> <span class="ibo-text-headline">' . $this->subPageTitle . '</span>'; 
      } else {
        
        echo '<a href="index.php"><i class="ibo-icon fas fa-home"></i></a> <i class="ibo-icon fas fa-angle-right"></i> <span class="ibo-text-headline">' . $this->mainPageTitle . '</span>'; 
      }
    }

  }

}