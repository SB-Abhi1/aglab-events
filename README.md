# Events & Activities Management — AG-Lab

A full-featured CRUD (Create, Read, Update, Delete) module built for managing laboratory events and activities, developed as part of a four-member team project for the official website of **AG-Lab** (Laboratory of Genomics and Transcriptomics), Dept. of Biochemistry & Molecular Biology, Shahjalal University of Science and Technology (SUST).

This module was independently designed and implemented as **Member 2's** contribution to the overall AG-Lab website database project, alongside three other modules (Contact & Inquiry, Research Projects, and Facilities & Equipment).



## Table of Contents

- [What This Project Does](#what-this-project-does)
- [Tech Stack](#tech-stack)
- [Database Schema](#database-schema)
- [Project Structure](#project-structure)
- [Routes](#routes)
- [Key Features](#key-features)
- [Validation Rules](#validation-rules)
- [How to Run Locally](#how-to-run-locally)
- [Screenshots](#screenshots)
- [Troubleshooting](#troubleshooting)
- [What I Built / Learned](#what-i-built--learned)
- [Future Improvements](#future-improvements)
- [Author](#author)



## What This Project Does

This module allows lab staff to manage a complete database of events and activities hosted by AG-Lab, including seminars, workshops, conferences, and training sessions. Specifically, it supports:

- **Adding** new events with full details (title, type, date, time, venue, speaker, description, image)
- **Viewing** all events in a responsive, searchable, and filterable grid layout
- **Editing** existing events, including replacing the event image
- **Deleting** events that are no longer needed, with automatic cleanup of uploaded image files
- **Searching** events by title, venue, or speaker name
- **Filtering** events by type (Seminar/Workshop/Event/Conference/Training) and status (Upcoming/Ongoing/Completed/Cancelled)
- **Paginating** results (9 events per page) for performance with larger datasets



## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 11 |
| Language | PHP 8.2+ |
| Database | MySQL |
| ORM | Eloquent |
| Frontend | Blade templates + Bootstrap 5 |
| Icons | Font Awesome 6 |
| Local server | Laragon (Apache + MySQL + Composer) |
| Dependency manager | Composer |
| Version control | Git / GitHub |



## Database Schema

The `events` table stores the following fields:

| Field | Type | Nullable | Description |
|---|---|---|---|
| id | BIGINT (PK, auto-increment) | No | Unique identifier for each event |
| title | VARCHAR(255) | No | Title of the event or activity |
| type | ENUM | No | One of: `Seminar`, `Workshop`, `Event`, `Conference`, `Training` |
| event_date | DATE | No | Date on which the event takes place |
| event_time | TIME | Yes | Scheduled start time |
| venue | VARCHAR(255) | Yes | Location where the event is held |
| speaker | VARCHAR(255) | Yes | Name of the speaker or guest |
| description | TEXT | No | Full description of the event |
| image | VARCHAR(255) | Yes | Storage path to the uploaded event image |
| status | ENUM | No | One of: `Upcoming`, `Ongoing`, `Completed`, `Cancelled` (default: `Upcoming`) |
| created_at | TIMESTAMP | — | Auto-managed by Laravel |
| updated_at | TIMESTAMP | — | Auto-managed by Laravel |

### Entity Notes

- This table is **independent** of the other three modules (Contact & Inquiry, Research Projects, Facilities & Equipment) — no foreign keys are required, keeping the module loosely coupled and easy to merge into the shared codebase.
- `type` and `status` are implemented as ENUM columns rather than free text, to keep the data consistent and to make filtering on the listing page reliable.



## Project Structure

```
app/
  Models/
    Event.php                       # Eloquent model — fillable fields, casts, accessors, scopes
  Http/
    Controllers/
      EventController.php           # Full CRUD logic (7 resource methods)
      Controller.php                # Base controller
  Providers/
    AppServiceProvider.php

database/
  migrations/
    create_users_table.php          # Laravel default (users, sessions, password_reset_tokens)
    create_events_table.php         # Custom — the events table
    create_cache_table.php          # Laravel default (cache, cache_locks)
    create_jobs_table.php           # Laravel default (jobs, job_batches, failed_jobs)
  seeders/
    DatabaseSeeder.php
    EventSeeder.php                 # Seeds 10+ demo events
  factories/
    EventFactory.php                # Faker-based factory for demo data

resources/
  views/
    layouts/
      app.blade.php                 # Shared layout — navbar, alerts, footer, custom AG-Lab theme
    events/
      index.blade.php               # List view — search, filters, pagination, card grid
      create.blade.php              # Add new event form
      edit.blade.php                # Edit existing event form
      show.blade.php                # Single event detail page
      _form.blade.php               # Shared form partial used by create & edit

routes/
  web.php                           # Route::resource('events', EventController::class)

public/
  storage/                          # Symlinked to storage/app/public (event images)
```



## Routes

All routes are registered with a single line — `Route::resource('events', EventController::class)` — which generates the following RESTful routes:

| Method | URI | Controller Action | Route Name | Purpose |
|---|---|---|---|---|
| GET | `/events` | `index` | `events.index` | List all events, with search/filter/pagination |
| GET | `/events/create` | `create` | `events.create` | Show the "Add New Event" form |
| POST | `/events` | `store` | `events.store` | Validate and save a new event |
| GET | `/events/{event}` | `show` | `events.show` | View full details of one event |
| GET | `/events/{event}/edit` | `edit` | `events.edit` | Show the pre-filled edit form |
| PUT/PATCH | `/events/{event}` | `update` | `events.update` | Validate and update an event |
| DELETE | `/events/{event}` | `destroy` | `events.destroy` | Delete an event and its image |



## Key Features

### 1. Search & Filter
The index page accepts three optional query parameters — `q` (search text), `type`, and `status` — combined via Eloquent query scopes (`scopeSearch`) and `where()` clauses, so staff can quickly narrow down a large list of events.

### 2. Image Upload with Cleanup
When a new image is uploaded during an update, the controller deletes the previously stored image file from `storage/app/public/events` before saving the new one, preventing orphaned files from accumulating.

```php
if ($request->hasFile('image')) {
    if ($event->image) {
        Storage::disk('public')->delete($event->image);
    }
    $validated['image'] = $request->file('image')->store('events', 'public');
}
```

### 3. Shared Form Partial
Both `create.blade.php` and `edit.blade.php` include the same `_form.blade.php` partial, so field additions or styling changes only need to be made in one place.

### 4. Demo Data Seeding
`EventSeeder.php` uses `EventFactory.php` (backed by Faker) to generate realistic demo events on first setup, so the module is immediately testable without manual data entry.



## Validation Rules

All input is validated server-side in `EventController@validateEvent`:

| Field | Rule |
|---|---|
| title | required, string, max 255 characters |
| type | required, must be one of the 5 defined types |
| event_date | required, valid date |
| event_time | optional, must match `H:i` format |
| venue | optional, string, max 255 characters |
| speaker | optional, string, max 255 characters |
| description | required, string |
| status | required, must be one of the 4 defined statuses |
| image | optional, must be an image (jpg/jpeg/png/webp), max 2MB |



## How to Run Locally

1. **Clone this repository**
   ```
   git clone <repository-url>
   cd aglab-events
   ```

2. **Install PHP dependencies**
   ```
   composer install
   ```

3. **Set up your environment file**
   ```
   copy .env.example .env
   ```
   Then update the database section:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=aglab_events
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate the application key**
   ```
   php artisan key:generate
   ```

5. **Create the database** (via HeidiSQL, phpMyAdmin, or the MySQL CLI) named `aglab_events`, matching the name set in `.env`.

6. **Run migrations and seed demo data**
   ```
   php artisan migrate --seed
   ```

7. **Create the storage symlink** (required for event images to display)
   ```
   php artisan storage:link
   ```

8. **Start the local server**
   ```
   php artisan serve
   ```

9. **Visit the module** in your browser:
   ```
   http://127.0.0.1:8000/events
   ```



## Screenshots

> Add screenshots to a `docs/screenshots/` folder and reference them here, for example:

| View | Screenshot |
|---|---|
| Event listing (search + filter) | `docs/screenshots/index.png` |
| Add new event form | `docs/screenshots/create.png` |
| Edit event form | `docs/screenshots/edit.png` |
| Event detail page | `docs/screenshots/show.png` |
| Delete confirmation | `docs/screenshots/delete-confirm.png` |



## Troubleshooting

| Issue | Cause | Fix |
|---|---|---|
| `No application encryption key has been specified` | `.env` key not generated | Run `php artisan key:generate` |
| `Table 'aglab_events.sessions' doesn't exist` | Laravel's default migrations weren't run | Run `php artisan migrate --seed` (make sure all migration files exist) |
| `The [public/storage] link already exists` | Symlink was already created | Safe to ignore — no action needed |
| Composer blocked by security advisories | Composer's advisory audit flags a pinned package version | Run `composer install --no-security-blocking` (or update the advisory config) |
| Uploaded images don't display | Storage symlink missing | Run `php artisan storage:link` |



## What I Built / Learned

- Designed a normalized database table for tracking laboratory events and activities
- Implemented complete CRUD functionality using Laravel's MVC architecture (Model, Controller, Blade views)
- Used Eloquent ORM and query scopes instead of raw SQL for search/filtering logic
- Applied Laravel's built-in validation and CSRF protection on all forms
- Used route model binding (`{event}` → `Event $event`) for cleaner, more readable controller methods
- Implemented file upload handling with `Storage::disk('public')`, including automatic cleanup of replaced/deleted images
- Built a reusable Blade partial to avoid duplicating form markup between create and edit views
- Used Laravel factories and seeders to generate realistic demo data for testing
- Styled the interface with Bootstrap 5 and a custom AG-Lab green theme for a clean, on-brand UI



## Future Improvements

- Merge this module into the shared AG-Lab website repository alongside the other three team modules
- Add an admin authentication layer if content management needs to be restricted
- Add a calendar view of upcoming events for the public-facing homepage
- Add automated tests (feature tests for each CRUD endpoint)



## Author
Shaishob Boidya (0222220005101049)
