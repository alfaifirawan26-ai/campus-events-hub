<?php
$page_title = "Events | Campus Events Hub";
require_once 'includes/functions.php';
include 'includes/header.php';
 
$events = load_events('data/events.csv');
?>
 
<section class="hero">
   <span class="badge">All Events</span>
   <h1>Upcoming Campus Events</h1>
   <p>Explore the full list of campus activities hosted by CSTS.</p>
</section>
 
<section class="event-list">
   <?php foreach ($events as $event): ?>
       <article class="card event-item">
           <div>
               <h3><?php echo htmlspecialchars($event['title']); ?></h3>
               <p class="meta">
                   <?php echo htmlspecialchars(date('j F Y', strtotime($event['date']))); ?>
                   | <?php echo htmlspecialchars($event['location']); ?>
               </p>
               <p><?php echo htmlspecialchars($event['description']); ?></p>
           </div>
           <a class="btn btn-primary" href="event.php?id=<?php echo urlencode($event['id']); ?>">Details</a>
       </article>
   <?php endforeach; ?>
</section>
 
<?php include 'includes/footer.php'; ?>
