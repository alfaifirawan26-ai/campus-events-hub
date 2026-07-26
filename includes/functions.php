<?php
/**
* Shared helper functions for Campus Events Hub
* CSV-based data handling for Week 3 PHP version
*/

function load_csv_assoc(string $filePath): array
{
   if (!file_exists($filePath)) {
       return [];
   }

   $rows = [];
   if (($handle = fopen($filePath, 'r')) === false) {
       return [];
   }

   $headers = fgetcsv($handle);
   if ($headers === false) {
       fclose($handle);
       return [];
   }

   while (($data = fgetcsv($handle)) !== false) {
       // للتأكد من تجاهل الأسطر الفارغة تماماً
       if ($data === [null] || empty($data)) {
           continue;
       }

       // التعديل هنا: يجب أن يكون عدد العناصر متساوياً تماماً (===) وليس فقط أقل من (<)
       if (count($data) !== count($headers)) {
           continue;
       }

       $rows[] = array_combine($headers, $data);
   }

   fclose($handle);
   return $rows;
}

function load_events(string $filePath = 'data/events.csv'): array
{
   $events = load_csv_assoc($filePath);

   usort($events, function ($a, $b) {
       return strcmp($a['date'] ?? '', $b['date'] ?? '');
   });

   return $events;
}

function get_event_by_id($id, string $filePath = 'data/events.csv'): ?array
{
   $events = load_events($filePath);

   foreach ($events as $event) {
       if (isset($event['id']) && (string)$event['id'] === (string)$id) {
           return $event;
       }
   }

   return null;
}

function load_registrations(string $filePath = 'data/registrations.csv'): array
{
   return load_csv_assoc($filePath);
}

function next_registration_id(string $filePath = 'data/registrations.csv'): int
{
   $registrations = load_registrations($filePath);
   if (empty($registrations)) {
       return 1;
   }

   $maxId = 0;
   foreach ($registrations as $row) {
       $currentId = (int)($row['id'] ?? 0);
       if ($currentId > $maxId) {
           $maxId = $currentId;
       }
   }

   return $maxId + 1;
}

function append_registration(array $row, string $filePath = 'data/registrations.csv'): bool
{
   $isNewFile = !file_exists($filePath);

   $handle = fopen($filePath, 'a');
   if ($handle === false) {
       return false;
   }

   if ($isNewFile) {
       fputcsv($handle, ['id', 'student_name', 'student_id', 'email', 'event_id', 'created_at']);
   }

   $result = fputcsv($handle, [
       $row['id'],
       $row['student_name'],
       $row['student_id'],
       $row['email'],
       $row['event_id'],
       $row['created_at']
   ]);

   fclose($handle);
   return $result !== false;
}
