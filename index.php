
<?php
$page_title = "Home | Campus Events Hub";
require_once 'includes/functions.php';
include 'includes/header.php';
 
$events = load_events('data/events.csv');
$top_events = array_slice($events, 0, 3);
?>
 
<section class="hero">
   <span class="badge">Computer Science & Tech Society</span>
   <h1>Welcome to Campus Events Hub</h1>
   <p>
       Discover workshops, seminars, competitions, and trips designed to help students learn,
       connect, and grow through campus activities.
   </p>
   <div class="btn-row">
       <a class="btn btn-primary" href="events.php">Browse Events</a>
       <a class="btn btn-secondary" href="register.php">Register Now</a>
   </div>
</section>
 
<section>
   <h2 class="section-title">Next 3 Upcoming Events</h2>
   <div class="grid-3">
       <?php foreach ($top_events as $event): ?>
           <article class="card">
               <h3><?php echo htmlspecialchars($event['title']); ?></h3>
               <p class="meta">
                   <?php echo htmlspecialchars(date('j F Y', strtotime($event['date']))); ?>
                   | <?php echo htmlspecialchars($event['location']); ?>
               </p>
               <p><?php echo htmlspecialchars($event['description']); ?></p>
               <a class="card-link" href="event.php?id=<?php echo urlencode($event['id']); ?>">View details</a>
           </article>
       <?php endforeach; ?>
   </div>
</section>
 
<section style="margin-top: 1.5rem;">
   <div class="grid-2">
       <article class="card">
           <h3>About CSTS</h3>
           <p>
               The Computer Science & Tech Society supports students who are interested in
               coding, software development, and technology-based learning experiences.
           </p>
       </article>
 
       <article class="card">
           <h3>Why Join?</h3>
           <p>
               Members get access to practical workshops, collaborative events, and opportunities
               to build skills beyond the classroom.
           </p>
       </article>
   </div>
</section>
 
<?php include 'includes/footer.php'; ?>
