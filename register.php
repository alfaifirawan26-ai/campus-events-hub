<?php
$page_title = "Register | Campus Events Hub";
require_once 'includes/functions.php';
include 'includes/header.php';
 
$events = load_events('data/events.csv');
 
$name = '';
$student_id = '';
$email = '';
$event_id = '';
$success_message = '';
$errors = [];
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $name = trim($_POST['name'] ?? '');
   $student_id = trim($_POST['student_id'] ?? '');
   $email = trim($_POST['email'] ?? '');
   $event_id = trim($_POST['event'] ?? '');
 
   if ($name === '') {
       $errors['name'] = 'Full name is required.';
   }
 
   if ($student_id === '') {
       $errors['student_id'] = 'Student ID is required.';
   } elseif (!preg_match('/^[0-9]+$/', $student_id)) {
       $errors['student_id'] = 'Student ID must contain numbers only.';
   }
 
   if ($email === '') {
       $errors['email'] = 'Email address is required.';
   } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $errors['email'] = 'Please enter a valid email address.';
   }
 
   $valid_event_ids = array_column($events, 'id');
   if ($event_id === '') {
       $errors['event'] = 'Please select an event.';
   } elseif (!in_array($event_id, $valid_event_ids, true)) {
       $errors['event'] = 'Selected event is invalid.';
   }
 
   if (empty($errors)) {
       $registration = [
           'id' => next_registration_id('data/registrations.csv'),
           'student_name' => $name,
           'student_id' => $student_id,
           'email' => $email,
           'event_id' => $event_id,
           'created_at' => date('Y-m-d H:i:s')
       ];
 
       if (append_registration($registration, 'data/registrations.csv')) {
           $success_message = 'Registration submitted successfully.';
           $name = '';
           $student_id = '';
           $email = '';
           $event_id = '';
       } else {
           $errors['file'] = 'Registration could not be saved. Please try again.';
       }
   }
}
?>
 
<section class="hero">
   <span class="badge">Registration</span>
   <h1>Event Registration Form</h1>
   <p>Complete this form to reserve your place in a campus event.</p>
</section>
 
<section class="card">
   <?php if ($success_message): ?>
       <div class="card" style="border-left: 5px solid #1d4ed8; margin-bottom: 1rem;">
           <strong><?php echo htmlspecialchars($success_message); ?></strong>
       </div>
   <?php endif; ?>
 
   <?php if (!empty($errors['file'])): ?>
       <div class="card" style="border-left: 5px solid #dc2626; margin-bottom: 1rem;">
           <strong><?php echo htmlspecialchars($errors['file']); ?></strong>
       </div>
   <?php endif; ?>
 
   <form action="register.php" method="post" novalidate>
       <div class="field">
           <label for="name">Full Name</label>
           <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" placeholder="Enter your full name">
           <?php if (!empty($errors['name'])): ?>
               <small class="small-text"><?php echo htmlspecialchars($errors['name']); ?></small>
           <?php endif; ?>
       </div>
 
       <div class="field">
           <label for="student_id">Student ID</label>
           <input type="text" id="student_id" name="student_id" value="<?php echo htmlspecialchars($student_id); ?>" placeholder="e.g. 220044622">
           <?php if (!empty($errors['student_id'])): ?>
               <small class="small-text"><?php echo htmlspecialchars($errors['student_id']); ?></small>
           <?php endif; ?>
       </div>
 
       <div class="field">
           <label for="email">Email Address</label>
           <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="student@university.edu">
           <?php if (!empty($errors['email'])): ?>
               <small class="small-text"><?php echo htmlspecialchars($errors['email']); ?></small>
           <?php endif; ?>
       </div>
 
       <div class="field">
           <label for="event">Select Event</label>
           <select id="event" name="event">
               <option value="">Choose an event</option>
               <?php foreach ($events as $event): ?>
                   <option value="<?php echo htmlspecialchars($event['id']); ?>" <?php echo ($event_id === $event['id']) ? 'selected' : ''; ?>>
                       <?php echo htmlspecialchars($event['title']); ?>
                   </option>
               <?php endforeach; ?>
           </select>
           <?php if (!empty($errors['event'])): ?>
               <small class="small-text"><?php echo htmlspecialchars($errors['event']); ?></small>
           <?php endif; ?>
       </div>
 
       <button class="btn btn-primary" type="submit">Submit Registration</button>
   </form>
 
   <p class="form-note" style="margin-top: 1rem;">
       This version includes server-side validation and saves valid registrations in the CSV file.
   </p>
</section>
 
<?
