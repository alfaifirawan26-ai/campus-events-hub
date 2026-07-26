<?php
$page_title = "Event Details | Campus Events Hub";
require_once 'includes/functions.php';
include 'includes/header.php';
 
$event = null;
$error = '';
 
if (isset($_GET['id']) && $_GET['id'] !== '') {
   $id = trim($_GET['id']);
   $event = get_event_by_id($id, 'data/events.csv');
   if ($event === null) {
       $error = 'The selected event was not found.';
   }
} else {
   $error = 'No event was selected.';
}
?>
 
<section class="hero">
   <span class="badge">Event Details</span>
   <h1>Selected Event Information</h1>
   <p>This page displays the details of one selected event using a GET parameter.</p>
</section>
 
<?php if ($event): ?>
   <article class="card">
       <h2 class="section-title"><?php echo htmlspecialchars($event['title']); ?></h2>
       <p class="meta">Date: <?php echo htmlspecialchars(date('j F Y', strtotime($event['date']))); ?></p>
       <p class="meta">Location: <?php echo htmlspecialchars($event['location']); ?></p>
 
       <p>
           <?php echo htmlspecialchars($event['description']); ?>
       </p>
 
       <h3>Event Highlights</h3>
       <ul>
           <li>Student-friendly campus activity</li>
           <li>Practical learning or participation opportunity</li>
           <li>Open registration through the website</li>
       </ul>
 
       <a class="btn btn-primary" href="register.php">Register for this event</a>
   </article>
<?php else: ?>
   <article class="card">
       <h2 class="section-title">Event Not Found</h2>
       <p class="small-text"><?php echo htmlspecialchars($error); ?></p>
       <a class="btn btn-primary" href="events.php">Back to Events</a>
   </article>
<?php endif; ?>
 
<?php include 'includes/footer.php'; ?>
 
