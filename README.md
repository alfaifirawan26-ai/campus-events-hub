# Campus Events Hub — Computer Science & Tech Society (CSTS)

## Project Overview
A dynamic web application designed for the Computer Science & Tech Society (CSTS). The platform publishes upcoming campus events (workshops, hackathons, seminars) and enables university students to register online.

## Team Members & Roles
- **Rawan Ahmad Ali Alfaifi** (220044622) — Team Lead & Structural Developer
- **Joury Nasir Al-juhani** (230032316) — UI/UX Designer & CSS Architect
- **Yara Mohammed Alasiri** (230011811) — Backend & Data Lead
- **Muneera Alhumaid** (230006036) — QA & Documentation Lead

## Tech Stack
- **Frontend:** HTML5, CSS3 (Responsive Design)
- **Backend:** Native PHP
- **Data Storage:** Local CSV Flat Files (`events.csv`, `registrations.csv`)

## Site Structure
- `index.php`: Home page featuring CSTS mission and 3 highlighted upcoming events.
- `events.php`: Full list of events dynamically rendered from the CSV data source.
- `event.php`: Individual event details page using URL GET parameters (`?id=X`).
- `register.php`: Event registration form with PHP server-side validation.
- `registrations.php`: Table displaying stored student event registrations.
- `contact.php`: Team profiles and validated contact inquiry form.

## How to Run Locally (XAMPP)
1. Clone or download this repository.
2. Move the `campus-events-hub` folder into your local XAMPP web root directory:
   - **Windows:** `C:\xampp\htdocs\campus-events-hub`
   - **macOS:** `/Applications/XAMPP/htdocs/campus-events-hub`
3. Launch the **Apache Server** using the XAMPP Control Panel.
4. Open your browser and navigate to: `http://localhost/campus-events-hub/index.php`.
