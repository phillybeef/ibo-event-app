<?php 

/**
 * Klasse Footer 
 *
 * View-Klasse für die Darstellung des Footers 
 *
 * @param   int $currentYear - aktuelles Jahr, wird im Copyright-Hinweis verwendet
 * @author  Philipp Wiens 
 */

class Footer {
  private $currentYear;

  public function __construct($currentYear){
    $this->currentYear = $currentYear; 
  }
  
  /**
   * Stellt den Footer dar und verwendet dafür alle weiteren Funktionen
   *
   * @author  Philipp Wiens 
   */   
  public function displayFooter(){
    
    echo '<footer class="container-fluid">';
      echo '<div class="container">';
        echo '<div class="row align-items-center justify-content-center">';
          echo '<div class="footer-address col-12 col-sm-12 col-md-6 col-lg-7 col-xl-7 order-2 order-md-1">';
      
    $this->displayAddresses(); 
    $this->displayLegalLinks(); 
    $this->displayCopyright(); 
      
          echo '</div>';
    
    $this->displaySocialLinks(); 
    
        echo '</div>';
      echo '</div>';
    echo '</footer>';

  }

  /**
   * Stellt den Adressbereich im Footer dar
   *
   * @author  Philipp Wiens 
   */   
  public function displayAddresses(){

    echo '<p>';
    echo '<b><span class="ibo-nobreak">ibo Software GmbH</span></b><br>';
    echo '<span class="ibo-nobreak">Im Westpark 8</span> | ';
    echo '<span class="ibo-nobreak">D-35435 Wettenberg</span> | ';
    echo '<span class="ibo-nobreak"><a href="tel:+4964198210700">+49 641 98210-700</a></span> | ';
    echo '<span class="ibo-nobreak"><a href="mailto:info@ibo.de">info@ibo.de</a></span>';
    echo '</p>';
    echo '<p>';
    echo '<b><span class="ibo-nobreak">ibo Akademie GmbH</span></b><br>';
    echo '<span class="ibo-nobreak">Im Westpark 8</span> | ';
    echo '<span class="ibo-nobreak">D-35435 Wettenberg</span> | ';
    echo '<span class="ibo-nobreak"><a href="tel:+4964198210300">+49 641 98210-300</a></span> | ';
    echo '<span class="ibo-nobreak"><a href="mailto:training@ibo.de">training@ibo.de</a></span>';
    echo '</p>';

  }


  /**
   * Stellt die Links 'AGB', 'Datenschutz' und 'Impressum' dar
   *
   * @author  Philipp Wiens 
   */   
  public function displayLegalLinks(){

    echo '<p>';
      echo '<b><span class="ibo-nobreak"><a href="https://www.ibo.de/agb" target="_blank">Datenschutz</a></span></b> | ';
      echo '<b><span class="ibo-nobreak"><a href="https://www.ibo.de/datenschutz" target="_blank">AGB</a></span></b> | ';
      echo '<b><span class="ibo-nobreak"><a href="https://www.ibo.de/impressum" target="_blank">Impressum</a></span></b>';
    echo '</p>';

  }


  /**
   * Stellt die Links zu Sozialen Netzwerken von ibo dar 
   *
   * @author  Philipp Wiens 
   */   
  public function displaySocialLinks(){

    echo '<div class="social-links col-12 col-sm-12 col-md-6 col-lg-5 col-xl-5 order-1 order-md-2">';
    echo '<div class="social-links-container">';
    echo '<ul>';
    echo '<li class="social-links-item">';
    echo '<a href="https://blog.ibo.de/" target="_blank">';
    echo '<img src="img/footer/blog.svg" alt="">';
    echo '</a>';
    echo '</li>';
    echo '<li class="social-links-item">';
    echo '<a href="https://www.facebook.com/ibogruppe/" target="_blank">';
    echo '<img src="img/footer/facebook.svg" alt="">';
    echo '</a>';
    echo '</li>';
    echo '<li class="social-links-item">';
    echo '<a href="https://twitter.com/ibo_gruppe" target="_blank">';
    echo '<img src="img/footer/twitter.svg" alt="">';
    echo '</a>';
    echo '</li>';
    echo '<li class="social-links-item">';
    echo '<a href="https://www.youtube.com/user/iboTraining" target="_blank">';
    echo '<img src="img/footer/youtube.svg" alt="">';
    echo '</a>';
    echo '</li>';
    echo '<li class="social-links-item" target="_blank">';
    echo '<a href="https://www.xing.com/companies/ibosoftwaregmbh" target="_blank">';
    echo '<img src="img/footer/xing.svg" alt="">';
    echo '</a>';
    echo '</li>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';

  }


  /**
   * Stellt den Copyright-Hinweis mit aktuellem Jahr dar 
   *
   * @author  Philipp Wiens 
   */   
  public function displayCopyright(){

    echo '<p class="copyright">';
    echo '&copy; '. $this->currentYear .' <span class="ibo-nobreak">ibo Software GmbH</span> &amp; <span class="ibo-nobreak">ibo Akademie GmbH</span> ';
    echo '</p>';

  }
  
}