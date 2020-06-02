<?php 

/**
 * Klasse Header 
 *
 * View-Klasse für die Darstellung des Headers 
 *
 * @param   string $mainPageTitle - Titel der Seite 
 * @param   string $subPageTitle - Titel der übergeordneten Seite
 * @param   Navigation $navigation - Objekt der eingebetteten Navigation
 * @author  Philipp Wiens 
 */

class Header {
  private $mainPageTitle; 
  private $subPageTitle; 
  public $navigation;

  public function __construct($mainPageTitle, $subPageTitle) {
    $this->mainPageTitle = $mainPageTitle; 
    $this->subPageTitle = $subPageTitle; 
    $this->navigation = new Navigation($this->mainPageTitle, $this->subPageTitle);
  }

  /**
   * Stellt den Header dar und verwendet dafür alle weiteren Funktionen
   *
   * @author  Philipp Wiens 
   */   
  public function displayHeader() {
  
    echo '<header class="ibo-header-container container mt-4 mb-2">';
      echo '<div class="ibo-header row h-100">';
        echo '<div class="ibo-logo col-12 col-md-4 offset-md-4 h-100">';
          echo '<img class="mx-auto d-block" src="img/Logo_ibo_Event_RGB_v01.png" alt="ibo Event Logo">';
        echo '</div>';

        $this->displayMediumUpBreadcrumbMenu();

      echo '</div>'; 
      echo '<div class="ibo-header row">';
        echo '<div class="ibo-bar col-12">';
          echo '<hr>';
        echo '</div>';
      echo '</div>';

        $this->displayMobileBreadcrumbMenu();

    echo '</header>'; 
  }

  /**
   * Stellt im Header das Breadcrumb-Menü für mobile Geräte dar und ruft dafür die entsprechende Methode der Klasse Navigation auf. Die Bootstrap4-Klasse 'd-md-none' macht das Element unsichtbar für Tablets aufwärts
   *
   * @author  Philipp Wiens 
   */   
  public function displayMobileBreadcrumbMenu(){
    echo '<div class="ibo-header row d-md-none">'; 
      echo '<div class="ibo-subtitle-mobile col-12 d-flex align-items-center mb-0">'; 
        echo '<div>'; 

          $this->navigation->displayBreadcrumbMenu(true);

        echo '</div>'; 
      echo '</div>'; 
    echo '</div>'; 
  }

  /**
   * Stellt im Header das Breadcrumb-Menü für Tablets aufwärts dar und ruft dafür die entsprechende Methode der Klasse Navigation auf. Die Bootstrap4-Klassen 'd-none d-md-block' machen das Element unsichtbar für mobile Geräte
   *
   * @author  Philipp Wiens 
   */   
  public function displayMediumUpBreadcrumbMenu(){

    echo '<div class="ibo-subtitle col-12 col-md-4 h-100 d-flex align-items-center justify-content-end">'; 
      echo '<div class="d-none d-md-block text-right pr-2">'; 

        $this->navigation->displayBreadcrumbMenu(false);

      echo '</div>'; 
    echo '</div>';

  }

}
