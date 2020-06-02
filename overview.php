<?php
    
    require 'DatabaseHandler.php'; 
    require 'Event.php';
    require 'AgendaSlot.php';
    require 'EventController.php';
    require 'AgendaController.php';
    require 'HotelInfoController.php';
    require 'HotelInfo.php';
    require 'Header.php';
    require 'Navigation.php';
    require 'Footer.php'; 
    require 'HeroSection.php'; 
    require 'HomeView.php'; 
    require 'OverviewView.php'; 
    
    setlocale(LC_TIME, "de_DE");

    $eventid = htmlspecialchars($_GET['eventid']); 
    $title = htmlspecialchars($_GET['title']); 

    $databaseHandler = new DatabaseHandler("localhost", "root", "root", "app"); 
    $databaseHandler->connectToDatabase(); 

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="styles/custom.css">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
    <title>ibo Event | <?php echo $title ?></title>
    
</head>
<body>


<?php
    
    $header = new Header($title, '');
    $header->displayHeader(); 

    $heroSection = new HeroSection('ibo_Dach_Wir_0420.jpg', false, 'center');
    $heroSection->displayHeroSection(); 

    $overviewView = new OverviewView($eventid); 
    $agenda = $overviewView->displayContent($databaseHandler); 



    $currentYear = date("Y"); 
    $footer = new Footer($currentYear); 
    $footer->displayFooter(); 
?>
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
      crossorigin="anonymous"></script>
    <script src="BookmarkController.js"></script>
    <script src="BookmarkSet.js"></script>

<?php
    $agendaCount = count($agenda); 
    echo '<script>';
    
        echo 'var bookmarkController = new BookmarkController('.$eventid.', '.$agendaCount.');';
        
        echo 'bookmarkController.createBookmarkSet();';
        echo 'bookmarkController.loadBookmarkSet();';
        
        echo 'window.addEventListener("beforeunload", function(e){'; 
            echo 'bookmarkController.saveBookmarkSet();';
        echo '}, false)';

    echo'</script>';
?>
    
</body>
</html>