<?php
$page_title = "Contact | Campus Events Hub";
include 'includes/header.php';
 
$contact_name = '';
$contact_email = '';
$message = '';
$contact_success = '';
$contact_errors = [];
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $contact_name = trim($_POST['contact_name'] ?? '');
   $contact_email = trim($_POST['contact_email'] ?? '');
   $message = trim($_POST['message'] ?? '');
 
   if ($contact_name === '') {
       $contact_errors['contact_name'] = 'Name is required.';
   }
 
   if ($contact_email === '') {
       $contact_errors['contact_email'] = 'Email is required.';
   } elseif (!filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
       $contact_errors['contact_email'] = 'Please enter a valid email address.';
   }
 
   if ($message === '') {
       $contact_errors['message'] = 'Message is required.';
   }
 
   if (empty($contact_errors)) {
       $contact_success = 'Your inquiry has been received successfully.';
       $contact_name = '';
       $contact_email = '';
       $message = '';
   }
}
?>
 
<section class="hero">
   <span class="badge">About / Contact</span>
   <h1>Team Members & Contact Form</h1>
   <p>Meet the project team and send a simple inquiry using the form below.</p>
</section>
 
<section class="grid-2">
   <article class="card">
       <h2 class="section-title">Team Members</h2>
       <ul>
           <li><strong>Rawan Ahmad Ali Alfaifi</strong> — Team Lead & Structural Developer</li>
           <li><strong>Joury Nasir Al-juhani</strong> — UI/UX Designer & CSS Architect</li>
           <li><strong>Yara Mohammed Alasiri</strong> — Backend & Data Lead</li>
           <li><strong>Muneera Alhumaid</strong> — QA & Documentation Lead</li>
       </ul>
   </article>
 
   <article class="card">
       <h2 class="section-title">Contact Form</h2>
 
       <?php if ($contact_success): ?>
           <div class="card" style="border-left: 5px solid #1d4ed8; margin-bottom: 1rem;">
               <strong><?php echo htmlspecialchars($contact_success); ?></strong>
           </div>
       <?php endif; ?>
 
       <form action="contact.php" method="post" novalidate>
           <div class="field">
               <label for="contact_name">Your Name</label>
               <input type="text" id="contact_name" name="contact_name" value="<?php echo htmlspecialchars($contact_name); ?>">
               <?php if (!empty($contact_errors['contact_name'])): ?>
                   <small class="small-text"><?php echo htmlspecialchars($contact_errors['contact_name']); ?></small>
               <?php endif; ?>
           </div>
 
           <div class="field">
               <label for="contact_email">Your Email</label>
               <input type="email" id="contact_email" name="contact_email" value="<?php echo htmlspecialchars($contact_email); ?>">
               <?php if (!empty($contact_errors['contact_email'])): ?>
                   <small class="small-text"><?php echo htmlspecialchars($contact_errors['contact_email']); ?></small>
               <?php endif; ?>
           </div>
 
           <div class="field">
               <label for="message">Message</label>
               <textarea id="message" name="message" placeholder="Write your message here..."><?php echo htmlspecialchars($message); ?></textarea>
               <?php if (!empty($contact_errors['message'])): ?>
                   <small class="small-text"><?php echo htmlspecialchars($contact_errors['message']); ?></small>
               <?php endif; ?>
           </div>
 
           <button class="btn btn-primary" type="submit">Send Message</button>
       </form>
   </article>
</section>
 
<?php include 'includes/footer.php'; ?>
