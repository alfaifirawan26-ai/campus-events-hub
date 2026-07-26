<?php
$page_title = "Registrations | Campus Events Hub";
require_once 'includes/functions.php';
include 'includes/header.php';
 
$registrations = load_registrations('data/registrations.csv');
$events = load_events('data/events.csv');
 
$event_map = [];
foreach ($events as $event) {
   $event_map[$event['id']] = $event['title'];
}
?>
 
<section class="hero">
   <span class="badge">Stored Registrations</span>
   <h1>Registration List</h1>
   <p>This page reads the saved registrations and displays them in an HTML table.</p>
</section>
 
<section class="table-wrap">
   <table>
       <thead>
           <tr>
               <th>ID</th>
               <th>Student Name</th>
               <th>Student ID</th>
               <th>Email</th>
               <th>Event</th>
               <th>Submitted At</th>
           </tr>
       </thead>
       <tbody>
           <?php if (empty($registrations)): ?>
               <tr>
                   <td colspan="6">No registrations have been submitted yet.</td>
               </tr>
           <?php else: ?>
               <?php foreach ($registrations as $row): ?>
                   <tr>
                       <td><?php echo htmlspecialchars($row['id'] ?? ''); ?></td>
                       <td><?php echo htmlspecialchars($row['student_name'] ?? ''); ?></td>
                       <td><?php echo htmlspecialchars($row['student_id'] ?? ''); ?></td>
                       <td><?php echo htmlspecialchars($row['email'] ?? ''); ?></td>
                       <td>
                           <?php
                           $eventId = $row['event_id'] ?? '';
                           echo htmlspecialchars($event_map[$eventId] ?? 'Unknown Event');
                           ?>
                       </td>
                       <td><?php echo htmlspecialchars($row['created_at'] ?? ''); ?></td>
                   </tr>
               <?php endforeach; ?>
           <?php endif; ?>
       </tbody>
   </table>
</section>
 
<
