<?php 

    require 'DatabaseHandler.php'; 
    require 'Header.php';
    require 'Navigation.php';
    require 'Footer.php'; 
    require 'HeroSection.php'; 
    require 'Speaker.php'; 
    require 'SpeakerController.php'; 
    

    $databaseHandler = new DatabaseHandler("localhost", "root", "root", "app"); 
    $databaseHandler->connectToDatabase(); 

    $title = htmlspecialchars($_GET['title']); 
    $speakerid = htmlspecialchars($_GET['speakerid']); 
    $speakerName = htmlspecialchars($_GET['speakername']); 
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
    <title><?php echo $speakerName  ?> | ibo Event</title>
    
</head>
<body>
      

<?php    

    $header = new Header('Home', '');
    $header->displayHeader(); 

    
    $resultSpeaker = $databaseHandler->fetchDataForSpeaker($speakerid);  
    
    $speakerController = new SpeakerController(); 
    
    $speakerObject = $speakerController->saveItemAsObject($resultSpeaker); 
    
    $speakerController->displayItemSection($speakerObject);
    

    $currentYear = date("Y"); 
    $footer = new Footer($currentYear); 
    $footer->displayFooter(); 

?>
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
      crossorigin="anonymous"></script>
    
    
</body>
</html>