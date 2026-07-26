<?php
if (!isset($page_title)) {
   $page_title = "Campus Events Hub";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo htmlspecialchars($page_title); ?></title>
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   <header class="site-header">
       <div class="container header-inner">
           <div>
               <a class="brand" href="index.php">Campus Events Hub</a>
               <p class="tagline">Computer Science & Tech Society (CSTS)</p>
           </div>
 
           <nav class="site-nav" aria-label="Main navigation">
               <a href="index.php">Home</a>
               <a href="events.php">Events</a>
               <a href="register.php">Register</a>
               <a href="registrations.php">Registrations</a>
               <a href="contact.php">Contact</a>
           </nav>
       </div>
   </header>
 
   <main class="container main-content">
